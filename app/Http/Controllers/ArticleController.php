<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ArticleController extends Controller implements HasMiddleware
{
    //metodo statico Middleware per proteggere le rotte dell'articleController
    public static function middleware()
    {
        return [
           new Middleware('auth', only: ['create']),//solo utenti autenticati possono accedere alla pagina create article
        ];
    }

    //funzione che mostra la pagina index degli articoli
    public function index()
    {
        //recupero dal DB gli articoli dal più recente al più vecchio e li impagino per 8 articoli alla volta
        $articles = Article::orderBy('created_at','desc')->paginate(8);

        return view('article.index',compact('articles'));
    }

    //funzione per creare un articolo
    public function create()
    {
        return view('article.create');
    }
}
