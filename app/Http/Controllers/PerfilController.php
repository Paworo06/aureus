<?php

namespace App\Http\Controllers;

use App\Models\Hermano;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{
    public function edit()
    {
        $user    = auth()->user();
        $hermano = Hermano::where('dni', $user->dni)->first();

        return view('perfil.edit', compact('user', 'hermano'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $rules = [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,'.$user->id,
            'telefono' => 'nullable|string|max:15',
            'direccion'=> 'nullable|string|max:150',
        ];

        // Solo validar contraseña si la rellena
        if ($request->filled('password')) {
            $rules['password']              = 'min:8|confirmed';
            $rules['password_confirmation'] = 'required';
        }

        $request->validate($rules);

        // Actualizar usuario
        $user->name  = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Actualizar hermano vinculado
        $hermano = Hermano::where('dni', $user->dni)->first();
        if ($hermano) {
            $hermano->telefono = $request->telefono;
            $hermano->direccion= $request->direccion;
            $hermano->save();
        }

        return redirect()->route('perfil.edit')
            ->with('success', 'Perfil actualizado correctamente.');
    }
}