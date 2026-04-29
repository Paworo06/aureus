<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Mail\BienvenidaMail;
use Illuminate\Support\Facades\Mail;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'dni'      => 'required|string|size:9|unique:users,dni',
            'email'    => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'dni'      => strtoupper($request->dni),
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Asignar rol según si existe como hermano
        $esHermano = \App\Models\Hermano::where('dni', strtoupper($request->dni))
                        ->exists();

        $user->assignRole($esHermano ? 'usuario' : 'usuario');

        event(new Registered($user));
        Auth::login($user);

        Mail::to($user->email)->send(new BienvenidaMail($user));
        return redirect()->route('dashboard');
    }
}