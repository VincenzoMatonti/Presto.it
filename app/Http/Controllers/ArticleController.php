<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ArticleController extends Controller implements HasMiddleware
{
    //metodo statico Middleware per proteggere le rotte dell'articleController
    public static function middleware()
    {
        return [
           new Middleware('auth', only: ['create']),//solo utenti autenticati possono accedere alla pagina "create article"
        ];
    }

    //funzione che mostra la pagina index degli articoli
    public function index()
    {
        //recupero dal DB gli articoli dal più recente al più vecchio e li impagino per 8 articoli alla volta
        $articles = Article::orderBy('created_at','desc')->paginate(8);

        return view('article.index',compact('articles'));
    }

    //funzione che mostra la pagina di dettaglio dell'articolo
    public function show(Article $article)
    {
       return view('article.show',compact('article'));//show è una funzione parametrica che porta come parametro "article" che inietto nella vista "article.show"
    }

    //funzione che mostra la pagina degli articoli filtrati per categoria
    public function byCategory(Category $category)
    {
       return view('article.byCategory',['articles' => $category->articles()->paginate(8),'category' => $category]);//inietto nella vista anche gli articoli legati alla categoria e la categoria stessa
    }

    //funzione che mostra la pagina per creare un articolo
    public function create()
    {
        return view('article.create');
    }
}
