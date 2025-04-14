<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            // Se non loggato, reindirizza al login con un messaggio
            return redirect()->route('login')->with('error', 'Devi accedere per vedere questa pagina.');
        }

        if (!Auth::user()->is_admin) {
            // Se loggato ma non admin, reindirizza indietro con messaggio
            return redirect()->back()->with('error', 'Accesso non autorizzato.');
        }

        return $next($request);
    }
}