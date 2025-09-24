<?php

namespace App\Http\Controllers;

use App\Models\Article;

class PublicController extends Controller
{
    //funzione che restituisce la vista dell'homepage
    public function homepage()
    {
       //recupero dal DB tramite model Article gli ultimi 6 article in ordine decrescente di data di creazione e inietto la variabile nella vista
       $articles = Article::take(4)->orderBy('created_at','desc')->get();

       return view('home.index',compact('articles'));
    }
}
