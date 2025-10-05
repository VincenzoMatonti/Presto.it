<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    //funzione che restituisce la vista dell'homepage
    public function homepage()
    {
       //recupero dal DB tramite model Article gli ultimi 4 article in ordine decrescente di data di creazione 
       //inoltre recupero solo gli articoli accettati
       $articles = Article::where('is_accepted', true)->orderBy('created_at','desc')->take(4)->get();

       return view('home.index',compact('articles'));
    }

    //metodo che permette la ricerca su dati indicizzati
    public function searchArticles(Request $request)
    {
       $query = $request->input('query');
       $articles = Article::search($query)->where('is_accepted',true)->paginate(8);
       return view('article.searched',['articles' => $articles,'query' => $query]);
    }

    //metodo per cambiare lingua
    public function setLanguage($lang)
    {
      session()->put('locale',$lang);
      return redirect()->back();
    }

    //metodo che restituisce la vista della pagina chi siamo
    public function aboutUs()
    {
      return view('aboutUs.index');
    }
}
