<?php

namespace App\Livewire\Revisor;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class DashboardRevisor extends Component
{

    use WithPagination;

    //proprietà per bootstrap
    protected $paginationTheme = 'bootstrap';

    //dichiaro una proprietà che conterrà solo gli articoli con is_checked su null(cioè da revisionare)
    public $articleToCheck;

    //dichiaro una proprietà che conterrà il numero degli articoli con is_checked su true(cioè accettati)
    public $articleCheckNumber;

    //dichiaro una proprietà che conterrà il numero degli articoli con is_checked su false(cioè rifiutati)
    public $articleRejectNumber;

    //proprietà per mostrare e chiudere tabella articoli accettati 
    public $showFormAccept = false;
    public $btnTextAccept;
    public $btnClassesAccept = "mybutton";

    //proprietà per mostrare e chiudere tabella articoli rifiutati 
    public $showFormReject = false;
    public $btnTextReject;
    public $btnClassesReject = "mybutton";

    //metodo per inizializzare le proprietà 
    public function mount()
    {
        $this->loadArticles();
        $this->btnTextAccept = __('ui.table');
        $this->btnTextReject = __('ui.table');
        $this->articleCheckNumber = Article::where('is_accepted', true)->get();
        $this->articleRejectNumber = Article::where('is_accepted', false)->get();
    }

    //metodo per caricare gli articoli per la dashboard
    public function loadArticles()
    {
        $this->articleToCheck = Article::where('is_accepted', null)->first(); //articolo da revisionare
    }

    //metodo per accettare l'articolo
    public function accept(Article $article)
    {
        $article->setAccepted(true);

        // Ricarica il prossimo articolo
        $this->loadArticles();

        session()->flash('message', __('ui.article_accepted', ['article' => $article->title]));
    }

    //metodo per rifiutare l'articolo
    public function reject(Article $article)
    {
        $article->setAccepted(false);

        // Ricarica il prossimo articolo
        $this->loadArticles();

        session()->flash('message', __('ui.article_rejected', ['article' => $article->title]));
    }

    //metodo per mandare in revisione un articolo
    public function revisionArticle(Article $article)
    {
        $article->setAccepted(null);

        //ricarico il prossimo articolo
        $this->loadArticles();

        session()->flash('message', __('ui.article_revisioned'));
    }

    //metodo per mostrare o chiudere la tabella degli articoli accettati
    public function showAcceptArticleTable()
    {
        if ($this->showFormAccept) {
            $this->showFormAccept = false;
            $this->btnTextAccept = __('ui.table');
            $this->btnClassesAccept = "mybutton";
        } else {
            $this->showFormAccept = true;
            $this->btnTextAccept = __('ui.operation');
            $this->btnClassesAccept = "btn-success";
        }
    }

    //metodo per mostrare o chiudere la tabella degli articoli rifiutati
    public function showRejectArticleTable()
    {
        if ($this->showFormReject) {
            $this->showFormReject = false;
            $this->btnTextReject = __('ui.table');
            $this->btnClassesReject = "mybutton";
        } else {
            $this->showFormReject = true;
            $this->btnTextReject = __('ui.operation');
            $this->btnClassesReject = "btn-success";
        }
    }


    public function render()
    {
        return view('livewire.revisor.dashboard-revisor', [
            'articleCheck' => Article::where('is_accepted', true)->orderBy('created_at', 'desc')->paginate(8),
            'articleReject' => Article::where('is_accepted', false)->orderBy('created_at', 'desc')->paginate(8),
        ]);
    }
}
