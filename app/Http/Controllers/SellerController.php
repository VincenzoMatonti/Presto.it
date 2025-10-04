<?php

namespace App\Http\Controllers;

use App\Mail\AcceptSeller;
use App\Mail\AdminAcceptSeller;
use App\Mail\AdminRejectSeller;
use App\Mail\BecomeSeller;
use App\Mail\RejectSeller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SellerController extends Controller
{

    //metodo che mostra l'index del seller
    public function index()
    {
        return view('seller.index');
    }

    //metodo per mandare la richieste per diventare rivenditore
    public function becomeSeller()
    {
        //controllo prima che l'utente loggato non è gia venditore
        if (!Auth::user()->is_seller) {
            Mail::to('admin@presto.it')->send(new BecomeSeller(Auth::user()));
            return redirect()->route('homepage')->with('message', __('ui.seller_request_sent'));
        } else {
            return redirect()->route('homepage')->with('errorMessage', __('ui.seller_already'));
        }
    }

    //metodo per rendere un utente venditore
    public function makeSeller(User $user)
    {
        //richiamo il comando custom creato che setta is_seller su true e rendo l'utente venditore
        Artisan::call('app:make-user-seller', ['email' => $user->email]);
        //gli do un riscontro all'utente inviandogli una mail
        Mail::to($user->email)->send(new AcceptSeller($user));
        //do un riscontro all'admin sull'operazione effettuata
        Mail::to('admin@presto.it')->send(new AdminAcceptSeller($user));

        return redirect()->back();
    }

    //metodo per rifiutare una richiesta per diventare venditore
    public function rejectSeller(User $user)
    {
        //richiamo il comando custom creato che setta is_seller su false e rifiuto la richiesta
        Artisan::call('app:reject-user-seller', ['email' => $user->email]);
        //gli do un riscontro all'utente inviandogli una mail
        Mail::to($user->email)->send(new RejectSeller($user));
        //do un riscontro all'admin sull'operazione effettuata
        Mail::to('admin@presto.it')->send(new AdminRejectSeller($user));

        return redirect()->back();
    }
}
