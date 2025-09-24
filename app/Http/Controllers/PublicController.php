<?php

namespace App\Http\Controllers;


class PublicController extends Controller
{
    //funzione che restituisce la vista dell'homepage
    public function homepage()
    {
       return view('home.index');
    }
}
