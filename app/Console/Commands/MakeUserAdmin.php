<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeUserAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-user-admin {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rende un utente Amministratore';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user =User::where('email', $this->argument('email'))->first();
        if(!$user) {
            $this->error('Utente non trovato');
            return;
        }
        $user->is_admin = true;
        $user->save();
        $this->info("l'utente {$user->name} è ora amministratore");
    }
}
