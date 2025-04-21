<?php

namespace App\Http\Controllers;

use App\Mail\AccountDeleted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ProfileController extends Controller
{
    

    public function destroy(Request $request)
    {
        $user = $request->user();
    
        // Invia la mail
        Mail::to($user->email)->send(new AccountDeleted($user));
    
        // Elimina l'utente
        $user->delete();
    
        // Logout e redirect
        Auth::logout();
    
        return redirect('/')->with('success', 'Il tuo account è stato eliminato.');
    }
}
