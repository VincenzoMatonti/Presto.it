<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RevisorController;
use Illuminate\Support\Facades\Route;

Route::get('/',[PublicController::class,'homepage'])->name('homepage');

//rotta per creare un articolo
Route::get('/create/article',[ArticleController::class,'create'])->name('create.article');

//rotta index di tutti gli articoli
Route::get('/index/article',[ArticleController::class,'index'])->name('index.article');

//rotta di dettaglio dell'articolo
Route::get('/show/article/{article}',[ArticleController::class,'show'])->name('detail.article');

//rotta che mostra gli articoli filtrati per categoria
Route::get('/category/{category}',[ArticleController::class,'byCategory'])->name('byCategory');

//rotta che mostra l'index del revisore
Route::get('/revisor/dashboard',[RevisorController::class,'index'])->middleware('isRevisor')->name('index.revisor');