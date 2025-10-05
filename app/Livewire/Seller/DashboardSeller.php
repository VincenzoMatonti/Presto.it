<?php

namespace App\Livewire\Seller;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class DashboardSeller extends Component
{

    use WithPagination;

    //proprietà per bootstrap
    protected $paginationTheme = 'bootstrap';

    //proprietà per mostrare e chiudere tabella articoli accettati 
    public $showFormAccept = false;
    public $btnTextAccept;
    public $btnClassesAccept = "mybutton";

    //proprietà per mostrare e chiudere tabella articoli rifiutati 
    public $showFormReject = false;
    public $btnTextReject;
    public $btnClassesReject = "mybutton";

    //proprietà per mostrare e chiudere tabella articoli in revisione 
    public $showFormReview = false;
    public $btnTextReview;
    public $btnClassesReview = "mybutton";

    //proprietà per mostrare e chiudere form per creare articolo
    public $showFormCreate = false;
    public $btnTextCreate;
    public $btnClassesCreate = "mybutton";

    //proprietà per mostrare e chiudere form per modificare articolo
    public $showFormEdit = false;

    //proprietà per passare l'articolo al form di modifica
    public $articleEdited;

    //dichiaro una proprietà che conterrà solo gli articoli con is_checked su null(cioè da revisionare)
    public $articleToCheck;

    //dichiaro una proprietà che conterrà il numero degli articoli con is_checked su true(cioè accettati)
    public $articleCheckNumber;

    //dichiaro una proprietà che conterrà il numero degli articoli con is_checked su false(cioè rifiutati)
    public $articleRejectNumber;


    //metodo per inizializzare le proprietà 
    public function mount()
    {
        $this->btnTextAccept = __('ui.table');
        $this->btnTextReject = __('ui.table');
        $this->btnTextReview = __('ui.table');
        $this->btnTextCreate = __('ui.publishArticle');
        $this->articleCheckNumber = Article::where('user_id', Auth::user()->id)
            ->where('is_accepted', true)
            ->get();
        $this->articleRejectNumber = Article::where('user_id', Auth::user()->id)
            ->where('is_accepted', false)
            ->get();
        $this->articleToCheck = Article::where('user_id', Auth::user()->id)
            ->where('is_accepted', null)
            ->get();
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

    //metodo per mostrare o chiudere la tabella degli articoli in revisione
    public function showReviewArticleTable()
    {
        if ($this->showFormReview) {
            $this->showFormReview = false;
            $this->btnTextReview = __('ui.table');
            $this->btnClassesReview = "mybutton";
        } else {
            $this->showFormReview = true;
            $this->btnTextReview = __('ui.operation');
            $this->btnClassesReview = "btn-success";
        }
    }

    //metodo per mostrare o chiudere il form per creare gli articoli
    public function showCreateArticleForm()
    {
        if ($this->showFormCreate) {
            $this->showFormCreate = false;
            $this->btnTextCreate = __('ui.publishArticle');
            $this->btnClassesCreate = "mybutton";
        } else {
            $this->showFormCreate = true;
            $this->btnTextCreate = __('ui.operation');
            $this->btnClassesCreate = "btn-success";
        }
    }

    //metodo per mostrare il form per modificare gli articoli
    public function showEditArticleForm($articleId)
    {
        // Chiudo eventuali altri form aperti
        $this->showFormCreate = false;
        $this->showFormAccept = false;
        $this->showFormReject = false;
        $this->showFormReview = false;
        $this->btnTextAccept = __('ui.table');
        $this->btnTextReject = __('ui.table');
        $this->btnTextReview = __('ui.table');
        $this->btnTextCreate = __('ui.publishArticle');
        $this->btnClassesAccept = "mybutton";
        $this->btnClassesReject = "mybutton";
        $this->btnClassesReview = "mybutton";
        $this->btnClassesCreate = "mybutton";

        // Trovo l’articolo
        $this->articleEdited = Article::findOrFail($articleId);

        // Mostro il form di modifica
        $this->showFormEdit = true;
    }

    //metodo per chiudere il form di modifica appena aggiornato un articolo   
    #[On('articleUpdated')]
    public function onArticleUpdated()
    {
        $this->showFormEdit = false;
        $this->articleEdited = null;
        session()->flash('success', __('ui.article_updated'));
    }

    //metodo per chiudere il form di modifica
    #[On('closeEditForm')]
    public function handleCloseEditForm()
    {
        $this->showFormEdit = false;
        $this->articleEdited = null;
    }

    //metodo per eliminare un articolo
    public function deleteArticle(Article $article)
    {
        $article->delete();
        session()->flash('message', __('ui.article_delete'));
    }

    public function render()
    {
        return view('livewire.seller.dashboard-seller', [
            'articleCheck' => Article::where('user_id', Auth::user()->id)
                ->where('is_accepted', true)
                ->orderBy('created_at', 'desc')
                ->paginate(8),
            'articleReject' => Article::where('user_id', Auth::user()->id)
                ->where('is_accepted', false)
                ->orderBy('created_at', 'desc')
                ->paginate(8),
            'articleReview' => Article::where('user_id', Auth::user()->id)
                ->where('is_accepted', null)
                ->orderBy('created_at', 'desc')
                ->paginate(8),
        ]);
    }
}
