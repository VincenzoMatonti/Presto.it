<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RevisorController;
use Illuminate\Support\Facades\Route;

//rotta homepage
Route::get('/',[PublicController::class,'homepage'])->name('homepage');

//rotta post per la richiesta di cambio lingua
Route::post('/lingua/{lang}',[PublicController::class,'setLanguage'])->name('setLocale');

//rotta per creare un articolo
Route::get('/create/article',[ArticleController::class,'create'])->name('create.article');

//rotta index di tutti gli articoli
Route::get('/index/article',[ArticleController::class,'index'])->name('index.article');

//rotta di dettaglio dell'articolo
Route::get('/show/article/{article}',[ArticleController::class,'show'])->name('detail.article');

//rotta che mostra gli articoli filtrati per categoria
Route::get('/category/{category}',[ArticleController::class,'byCategory'])->name('byCategory');

//rotta che mostra gli articoli ricercati tramite la ricerca full text
Route::get('/search/article',[PublicController::class,'searchArticles'])->name('article.search');

//rotta che mostra l'index del revisore
Route::get('/revisor/dashboard',[RevisorController::class,'index'])->middleware('isRevisor')->name('index.revisor');

//rotta per far partire la mail per richiesta di diventare revisore
Route::get('revisor/request',[RevisorController::class,'becomeRevisor'])->middleware('auth')->name('become.revisor');

//rotta per rendere un utente revisore
Route::get('/make/revisor/{user}',[RevisorController::class,'makeRevisor'])->name('make.revisor');

//rotta per rifiutare la richiesta di un utente per diventare revisore
Route::get('/reject/revisor/{user}',[RevisorController::class,'rejectRevisor'])->name('reject.revisor');