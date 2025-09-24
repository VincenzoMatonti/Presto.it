<?php

namespace App\Http\Controllers;

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

    //funzione per creare un articolo
    public function create()
    {
        return view('article.create');
    }
}
