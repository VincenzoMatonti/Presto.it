<?php

namespace App\Jobs;

use App\Models\Image;
use Google\Cloud\Vision\V1\Client\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\Feature;
use Google\Cloud\Vision\V1\Image as VisionImage;
use Google\Cloud\Vision\V1\AnnotateImageRequest;
use Google\Cloud\Vision\V1\BatchAnnotateImagesRequest;
use Google\ApiCore\ApiException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class GoogleVisionLabelImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // Numero massimo di tentativi prima che il job fallisca definitivamente
    public $tries = 10;

    // Tempo di attesa tra un retry e l'altro in secondi
    public $backoff = 20;

    private int $articleImageId;

    public function __construct(int $articleImageId)
    {
        $this->articleImageId = $articleImageId;
    }

    public function handle(): void
    {
        $imageModel = Image::find($this->articleImageId);

        if (!$imageModel) {
            Log::warning("GoogleVisionLabelImage: immagine non trovata con ID {$this->articleImageId}");
            return;
        }

        $imagePath = storage_path('app/public/' . $imageModel->path);

        if (!file_exists($imagePath)) {
            Log::error("GoogleVisionLabelImage: file immagine non trovato: $imagePath");
            return;
        }

        $fileSize = filesize($imagePath);
        Log::info("GoogleVisionLabelImage: elaborazione immagine ID {$this->articleImageId}, dimensione: {$fileSize} bytes");

        $credentialsPath = base_path('google_credential.json');

        if (!file_exists($credentialsPath)) {
            Log::error("GoogleVisionLabelImage: credenziali mancanti in $credentialsPath");
            return;
        }

        putenv("GOOGLE_APPLICATION_CREDENTIALS=$credentialsPath");

        try {
            $client = new ImageAnnotatorClient();

            // Costruisci l'immagine
            $visionImage = new VisionImage();
            $visionImage->setContent(file_get_contents($imagePath));

            // Feature LABEL_DETECTION
            $feature = new Feature();
            $feature->setType(Feature\Type::LABEL_DETECTION);

            // AnnotateImageRequest
            $annotateRequest = new AnnotateImageRequest();
            $annotateRequest->setImage($visionImage);
            $annotateRequest->setFeatures([$feature]);

            // BatchAnnotateImagesRequest
            $batchRequest = new BatchAnnotateImagesRequest();
            $batchRequest->setRequests([$annotateRequest]);

            $response = $client->batchAnnotateImages($batchRequest);
            $responses = $response->getResponses();

            if (empty($responses)) {
                Log::error("GoogleVisionLabelImage: risposta vuota per immagine ID {$this->articleImageId}");
                return;
            }

            $labels = $responses[0]->getLabelAnnotations();

            if (!$labels) {
                Log::warning("GoogleVisionLabelImage: nessuna label rilevata per immagine ID {$this->articleImageId}");
                return;
            }

            $result = [];
            foreach ($labels as $label) {
                $result[] = $label->getDescription();
            }

            $imageModel->labels = $result;
            $imageModel->save();

            Log::info("GoogleVisionLabelImage: labels salvate per immagine ID {$this->articleImageId}", [
                'labels' => $result
            ]);

            $client->close();
        } catch (ApiException $e) {
            // Gestione rate limit di Google Vision
            if ($e->getStatus() === 'RESOURCE_EXHAUSTED') {
                Log::warning("GoogleVisionLabelImage: rate limit superato per immagine ID {$this->articleImageId}. Riprovo tra {$this->backoff} secondi.");
                $this->release($this->backoff); // ritenta il job dopo il backoff
                return;
            }
            Log::error("GoogleVisionLabelImage: errore API per immagine ID {$this->articleImageId}: ".$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
        } catch (\Throwable $e) {
            Log::error("GoogleVisionLabelImage: errore imprevisto per immagine ID {$this->articleImageId}: ".$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }
}
