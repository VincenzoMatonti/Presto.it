<?php

namespace App\Http\Controllers;

use App\Mail\AcceptRevisor;
use App\Mail\AdminAcceptRevisor;
use App\Mail\AdminRejectRevisor;
use App\Mail\BecomeRevisor;
use App\Mail\RejectRevisor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RevisorController extends Controller
{
    //funzione che restituisce la vista dell'index del revisore
    public function index()
    {
        return view('revisor.index');
    }

    //metodo per inviare la richiesta per diventare revisore
    public function becomeRevisor()
    {
        //controllo prima che l'utente loggato non è gia revisor
        if (!Auth::user()->is_revisor) {
            Mail::to('admin@presto.it')->send(new BecomeRevisor(Auth::user()));
            return redirect()->route('homepage')->with('message','Complimenti,Hai richiesto di diventare revisor!');
        } else {
            return redirect()->route('homepage')->with('errorMessage','Sei gia revisor,non puoi mandare una richiesta!');
        }
    }

    //metodo per rendere un utente revisore
    public function makeRevisor(User $user)
    {
        //richiamo il comando custom creato che setta is_revisor su true e rendo l'utente revisor
        Artisan::call('app:make-user-revisor',['email' => $user->email]);
        //gli do un riscontro all'utente inviandogli una mail
        Mail::to($user->email)->send(new AcceptRevisor($user));
        //do un riscontro all'admin sull'operazione effettuata
        Mail::to('admin@presto.it')->send(new AdminAcceptRevisor($user));

        return redirect()->back();
    }

    //metodo per rifiutare una richiesta per diventare revisore
    public function rejectRevisor(User $user)
    {
        //richiamo il comando custom creato che setta is_revisor su false e rifiuto la richiesta
        Artisan::call('app:reject-user-revisor',['email' => $user->email]);
        //gli do un riscontro all'utente inviandogli una mail
        Mail::to($user->email)->send(new RejectRevisor($user));
        //do un riscontro all'admin sull'operazione effettuata
        Mail::to('admin@presto.it')->send(new AdminRejectRevisor($user));

        return redirect()->back();
    } 
}
