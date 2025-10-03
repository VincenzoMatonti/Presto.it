<?php

namespace App\Livewire\Article;

use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionSafeSearch;
use App\Jobs\ResizeImage;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateArticleForm extends Component
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

    public $images = []; //immagini validate pronte per il salvataggio nel DB 
    #[Validate('array|max:6')]
    public $temporary_images = []; // immagini temporane caricate dall'utente

    public $article;

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
    }

    //metodo per valorizzare $images
    //monitoriamo e aggiorniamo in tempo reale i cambiamenti della proprietà temporary_images
    //proprietà pubblica aggiornata sul client prima che il component venga aggiornato sul server
    public function updatedTemporaryImages()
    {
        $this->validate([
            'temporary_images.*' => 'image|max:1024',
            'temporary_images'   => 'array|max:6'
        ]);

        // Aggiungi solo le nuove immagini senza cancellare le vecchie
        $newImages = array_slice($this->temporary_images, 0, 6 - count($this->images));

        // Unisci con le immagini già caricate
        $this->images = array_merge($this->images, $newImages);

    }

    //metodo per eliminare le immagini singolarmente dal caricamento
    public function removeImage($key)
    {
        if (in_array($key, array_keys($this->images))) {
            unset($this->images[$key]);
        }
    }


    //funzione per salvare l'articolo nel DB
    public function store()
    {
        //valido i campi del form
        $this->validate();
        $this->article = Article::create([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category,
            'user_id' => Auth::id()
        ]);

        
        if (count($this->images) > 0) {
            foreach ($this->images as $image) {
                $newFileName = "articles/{$this->article->id}";
                $newImage = $this->article->images()->create(['path' => $image->store($newFileName, 'public')]);
                dispatch(new ResizeImage($newImage->path, 300, 300));
                dispatch(new GoogleVisionSafeSearch($newImage->id));
                dispatch(new GoogleVisionLabelImage($newImage->id));
            }
            File::deleteDirectory(storage_path('/app/livewire-tmp'));
        }

        //do riscontro visivo all'utente della creazione dell'articolo avvenuta con successo
        session()->flash('success', __('ui.article_created'));
        //pulisco i campi del form
        $this->cleanForm();
    }

    public function render()
    {
        return view('livewire.article.create-article-form');
    }
}
