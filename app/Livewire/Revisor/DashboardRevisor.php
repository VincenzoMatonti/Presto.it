<?php

namespace App\Livewire\Revisor;

use App\Models\Article;
use Livewire\Component;

class DashboardRevisor extends Component
{
    //dichiaro una proprietà che conterrà solo gli articoli con is_checked su null(cioè da revisionare)
    public $articleToCheck;

    //dichiaro una proprietà che conterrà solo gli articoli con is_checked su true(cioè accettati)
    public $articleCheck;

    //dichiaro una proprietà che conterrà solo gli articoli con is_checked su false(cioè rifiutati)
    public $articleReject;

    //metodo per inizializzare le proprietà 
    public function mount()
    {
        $this->loadArticles();
    }

    //metodo per caricare gli articoli per la dashboard
    public function loadArticles()
    {
        $this->articleToCheck = Article::where('is_accepted', null)->first(); //articolo da revisionare
        $this->articleCheck = Article::where('is_accepted', true)->get(); //articoli accettati
        $this->articleReject = Article::where('is_accepted', false)->get(); //articoli rifiutati
    }

    //metodo per accettare l'articolo
    public function accept(Article $article)
    {
        $article->setAccepted(true);

        // Ricarica il prossimo articolo
        $this->loadArticles();

        session()->flash('message', "Hai accettato l'articolo \"$article->title\"");
    }

    //metodo per rifiutare l'articolo
    public function reject(Article $article)
    {
        $article->setAccepted(false);

        // Ricarica il prossimo articolo
        $this->loadArticles();

        session()->flash('message', "Hai rifiutato l'articolo \"$article->title\"");
    }

    public function render()
    {
        return view('livewire.revisor.dashboard-revisor');
    }
}
