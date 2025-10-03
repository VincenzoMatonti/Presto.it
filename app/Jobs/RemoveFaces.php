<?php

namespace App\Jobs;

use App\Models\Image;
use Google\Cloud\Vision\V1\Feature;
use Google\Cloud\Vision\V1\Image as VisionImage;

use Google\Cloud\Vision\V1\AnnotateImageRequest;
use Google\Cloud\Vision\V1\BatchAnnotateImagesRequest;
use Google\Cloud\Vision\V1\Client\ImageAnnotatorClient;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Spatie\Image\Enums\AlignPosition;
use Spatie\Image\Enums\Fit;
use Spatie\Image\Image as SpatieImage;

class RemoveFaces implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $articleImageId;

    public function __construct($articleImageId)
    {
        $this->articleImageId = $articleImageId;
    }

    public function handle(): void
    {
        Log::info("Job RemoveFaces avviato per image ID: {$this->articleImageId}");

        $imageModel = Image::find($this->articleImageId);
        if (!$imageModel) {
            Log::error("Immagine non trovata per ID: {$this->articleImageId}");
            return;
        }

        $srcPath = storage_path('app/public/' . $imageModel->path);
        Log::info("Percorso immagine: {$srcPath}");

        $imageContent = file_get_contents($srcPath);
        if (!$imageContent) {
            Log::error("Impossibile leggere il contenuto dell'immagine: {$srcPath}");
            return;
        }

        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path('google_credential.json'));

        $imageAnnotator = new ImageAnnotatorClient();

        try {
            Log::info("Inizio annotazione immagine con Google Vision API");

            // Crea oggetto VisionImage
            $visionImage = new VisionImage();
            $visionImage->setContent($imageContent);

            // Feature per rilevamento facce
            $feature = new Feature();
            $feature->setType(Feature\Type::FACE_DETECTION);

            // Crea AnnotateImageRequest
            $annotateImageRequest = new AnnotateImageRequest();
            $annotateImageRequest->setImage($visionImage);
            $annotateImageRequest->setFeatures([$feature]);

            // Crea BatchAnnotateImagesRequest
            $batchRequest = new BatchAnnotateImagesRequest();
            $batchRequest->setRequests([$annotateImageRequest]);

            // Esegui annotazione
            $response = $imageAnnotator->batchAnnotateImages($batchRequest);
            $faces = $response->getResponses()[0]->getFaceAnnotations();

            Log::info("Numero di volti rilevati: " . count($faces));

            foreach ($faces as $index => $face) {
                $vertices = $face->getBoundingPoly()->getVertices();

                $bounds = [];

                foreach ($vertices as $vertex) {
                    $bounds[] = [$vertex->getX(), $vertex->getY()];
                }

                $w = $bounds[2][0] - $bounds[0][0];
                $h = $bounds[2][1] - $bounds[0][1];

                $image = SpatieImage::load($srcPath);
                $image->watermark(
                    base_path('resources/img/smile.png'),
                    AlignPosition::TopLeft,
                    paddingX: $bounds[0][0],
                    paddingY: $bounds[0][1],
                    width: $w,
                    height: $h,
                    fit: Fit::Stretch
                );
                $image->save($srcPath);

                Log::info("Volto #{$index} modificato con watermark.");
            }

            Log::info("Job RemoveFaces completato per image ID: {$this->articleImageId}");

        } catch (\Exception $e) {
            Log::error("Errore durante l'elaborazione dei volti: " . $e->getMessage());
        } finally {
            $imageAnnotator->close();
        }
    }
}
