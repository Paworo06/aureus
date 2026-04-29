<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckActivo
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && !Auth::user()->activo) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')
                ->with('error', 'Tu cuenta ha sido desactivada. 
                        Contacta con el administrador.');
        }

        return $next($request);
    }
}