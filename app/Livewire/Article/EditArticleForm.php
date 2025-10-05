<?php

namespace App\Livewire\Article;


use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionSafeSearch;
use App\Jobs\RemoveFaces;
use App\Jobs\ResizeImage;
use App\Models\Article;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditArticleForm extends Component
{

    use WithFileUploads;

    //attributi con regole di validazione
    #[Validate('required|min:5')]
    public $title;
    #[Validate('required|min:10')]
    public $description;
    #[Validate('required|numeric')]
    public $price;
    #[Validate('required')]
    public $category;

    public $images = []; //immagini gia salvate + le temporanee
    #[Validate('array|max:6')]
    public $temporary_images = []; // immagini caricate dall'utente

    public $article;

    public $categories;

    //metodo per inizializzare le proprietà 
    public function mount(Article $article)
    {
        //precompilo i campi con i dati esistenti
        $this->article = $article;
        $this->title = $article->title;
        $this->description = $article->description;
        $this->price = $article->price;
        $this->category = $article->category_id;
        $this->images = $article->images()->get()->all();
        $this->categories = Category::all();
    }

    //funzione che restituise il messaggio specifico personalizzato per ogni tipo di errore di validazione
    public function messages()
    {
        return [
            'title.required' => __('ui.title_required'),
            'title.min' => __('ui.title_min'),
            'description.required' => __('ui.description_required'),
            'description.min' => __('ui.description_min'),
            'price.required' => __('ui.price_required'),
            'price.numeric' => __('ui.price_numeric'),
            'category.required' => __('ui.category_required'),
            'temporary_images.*.image' => __('ui.images_error'),
            'temporary_images.max' => __('ui.images_numeric'),
            'temporary_images.*.max' => __('ui.images_max'),
            'temporary_images.array' => __('ui.images_array'),
        ];
    }

    //funzione custom per pulire i campi del form
    protected function cleanForm()
    {
        $this->title = '';
        $this->description = '';
        $this->price = '';
        $this->category = '';
        $this->images = [];
        $this->temporary_images = [];
    }

    // Aggiornamento immagini temporanee
    public function updatedTemporaryImages()
    {
        $this->validate([
            'temporary_images.*' => 'image|max:1024',
            'temporary_images'   => 'array|max:6'
        ]);

        // Aggiungi solo le nuove immagini senza superare il limite
        $newImages = array_slice($this->temporary_images, 0, 6 - count($this->images));

        // Unisci con le immagini già caricate
        $this->images = array_merge($this->images, $newImages);
    }

    //metodo per eliminare le immagini singolarmente dal caricamento
    public function removeImage($key)
    {
        if (!isset($this->images[$key])) {
            return; // sicurezza chiave non esistente
        }

        $image = $this->images[$key];

        if ($image instanceof Image) {
            Storage::delete($image->path);
            $image->delete();
        }

        unset($this->images[$key]);

        // Ricompone l'array per evitare chiavi "vuote"
        $this->images = array_values($this->images);
    }

    //metodo per aggiornare un articolo
    public function update()
    {
        $this->validate();

        $this->article->update([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category,
        ]);

        // Gestione immagini temporanee
        if (!empty($this->temporary_images)) {
            foreach ($this->temporary_images as $image) {
                $newFileName = "articles/{$this->article->id}";
                $newImage = $this->article->images()->create([
                    'path' => $image->store($newFileName, 'public')
                ]);

                RemoveFaces::withChain([
                    new ResizeImage($newImage->path, 300, 300),
                    new GoogleVisionSafeSearch($newImage->id),
                    new GoogleVisionLabelImage($newImage->id)
                ])->dispatch($newImage->id);
            }

            // Pulisce la cartella temporanea di Livewire
            File::deleteDirectory(storage_path('/app/livewire-tmp'));
        }

        // Rimanda l'articolo in revisione
        $this->article->setAccepted(null);

        $this->cleanForm();

        session()->flash('success', __('ui.article_updated'));
        $this->dispatch('articleUpdated');
    }

    //metodo per chiudere il form
    public function closeForm()
    {
        // Pulisce eventuali campi
        $this->cleanForm();

        // Notifica il componente padre di chiudere il form
        $this->dispatch('closeEditForm');
    }

    public function render()
    {
        return view('livewire.article.edit-article-form');
    }
}
