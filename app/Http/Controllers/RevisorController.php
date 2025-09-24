<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RevisorController extends Controller
{
    //funzione che restituisce la vista dell'index del revisore
    public function index()
    {
        return view('revisor.index');
    }
}
