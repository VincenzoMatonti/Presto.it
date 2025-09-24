<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('/',[PublicController::class,'homepage'])->name('homepage');

//rotta per creare un articolo
Route::get('/create/article',[ArticleController::class,'create'])->name('create.article');

//rotta index di tutti gli articoli
Route::get('/index/article',[ArticleController::class,'index'])->name('index.article');