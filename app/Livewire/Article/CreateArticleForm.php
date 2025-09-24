<?php

namespace App\Livewire\Article;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateArticleForm extends Component
{
    //attributi con regole di validazione
    #[Validate('required|min:5')]
    public $title;
    #[Validate('required|min:10')]
    public $description;
    #[Validate('required|numeric')]
    public $price;
    #[Validate('required')]
    public $category;

    public $article;

    //funzione che restituise il messaggio specifico personalizzato per ogni tipo di errore di validazione
    public function messages()
    {
        return [
           'title.required' => 'Il titolo è obbligatorio!',
           'title.min' => 'Il titolo deve essere minimo 5 caratteri!',
           'description.required' => 'La descrizione è obbligatoria',
           'description.min' => 'La descrizione deve essere minima 10 caratteri',
           'price.required' => 'Il prezzo è obbligatorio',
           'price.numeric' => 'Inserisci un numero!',
           'category.required' => 'La categoria è obbligatoria!',
        ];
    }

    //funzione custom per pulire i campi del form
    protected function cleanForm()
    {
        $this->title = '';
        $this->description = '';
        $this->price = '';
        $this->category = '';
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

        //pulisco i campi del form
        $this->cleanForm();

        //do riscontro visivo all'utente della creazione dell'articolo avvenuta con successo
        session()->flash('success','Articolo creato correttamente!');

    }

    public function render()
    {
        return view('livewire.article.create-article-form');
    }
}
