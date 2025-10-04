<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeUserSeller extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-user-seller {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rende un utente venditore';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //ricerca utente tramite il parametro specificato "email"
        $user = User::where('email', $this->argument('email'))->first();
        //se c'è mancata corrispondenza nel db messaggio di errore
        if (!$user) {
            $this->error('Utente non trovato');
            return;
        }
        //se l'utente viene trovato il suo record viene aggiornato diventando venditore
        $user->is_seller = true;
        $user->save();
        $this->info("L'utente {$user->name} è ora venditore");
    }
}
