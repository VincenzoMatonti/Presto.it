<?php

namespace App\Jobs;

use App\Models\Image;
use Google\Cloud\Vision\V1\Client\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\BatchAnnotateImagesRequest;
use Google\Cloud\Vision\V1\AnnotateImageRequest;
use Google\Cloud\Vision\V1\Feature;
use Google\Cloud\Vision\V1\Image as VisionImage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class GoogleVisionSafeSearch implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private int $articleImageId;

    public function __construct(int $articleImageId)
    {
        $this->articleImageId = $articleImageId;
    }

    public function handle(): void
    {
        $imageModel = Image::find($this->articleImageId);
        if (!$imageModel) {
            Log::warning("GoogleVisionSafeSearch: immagine non trovata con ID {$this->articleImageId}");
            return;
        }

        $imagePath = storage_path('app/public/' . $imageModel->path);
        if (!file_exists($imagePath)) {
            Log::error("GoogleVisionSafeSearch: file immagine non trovato: $imagePath");
            return;
        }

        $credentialsPath = env('GOOGLE_APPLICATION_CREDENTIALS', base_path('google_credential.json'));
        if (!file_exists($credentialsPath)) {
            Log::error("GoogleVisionSafeSearch: credenziali mancanti in $credentialsPath");
            return;
        }

        putenv("GOOGLE_APPLICATION_CREDENTIALS=$credentialsPath");

        try {
            $client = new ImageAnnotatorClient();

            // Costruisci l'immagine
            $visionImage = new VisionImage();
            $visionImage->setContent(file_get_contents($imagePath));

            // Feature SAFE_SEARCH
            $feature = new Feature();
            $feature->setType(Feature\Type::SAFE_SEARCH_DETECTION);

            // AnnotateImageRequest
            $annotateRequest = new AnnotateImageRequest();
            $annotateRequest->setImage($visionImage);
            $annotateRequest->setFeatures([$feature]);

            // BatchAnnotateImagesRequest
            $batchRequest = new BatchAnnotateImagesRequest();
            $batchRequest->setRequests([$annotateRequest]);

            $response = $client->batchAnnotateImages($batchRequest);
            $annotation = $response->getResponses()[0]->getSafeSearchAnnotation();

            if (!$annotation) {
                Log::warning("GoogleVisionSafeSearch: nessuna annotazione per immagine ID {$this->articleImageId}");
                return;
            }

            $likelihoodMap = [
                0 => 'text-secondary bi bi-circle-fill',       // UNKNOWN
                1 => 'text-success bi bi-check-circle-fill',  // VERY_UNLIKELY
                2 => 'text-success bi bi-check-circle-fill',  // UNLIKELY
                3 => 'text-warning bi bi-exclamation-circle-fill', // POSSIBLE
                4 => 'text-warning bi bi-exclamation-circle-fill', // LIKELY
                5 => 'text-danger bi bi-dash-circle-fill',    // VERY_LIKELY
            ];

            $imageModel->adult    = $likelihoodMap[$annotation->getAdult()] ?? $likelihoodMap[0];
            $imageModel->spoof    = $likelihoodMap[$annotation->getSpoof()] ?? $likelihoodMap[0];
            $imageModel->racy     = $likelihoodMap[$annotation->getRacy()] ?? $likelihoodMap[0];
            $imageModel->medical  = $likelihoodMap[$annotation->getMedical()] ?? $likelihoodMap[0];
            $imageModel->violence = $likelihoodMap[$annotation->getViolence()] ?? $likelihoodMap[0];

            $imageModel->save();

            Log::info("GoogleVisionSafeSearch: annotazione completata per immagine ID {$this->articleImageId}");
            $client->close();
        } catch (\Throwable $e) {
            Log::error("GoogleVisionSafeSearch: errore per immagine ID {$this->articleImageId}: " . $e->getMessage());
        }
    }
}
