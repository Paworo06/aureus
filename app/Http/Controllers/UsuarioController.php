<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\AuditoriaService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Mail\AvisoAltaBajaMail;
use Illuminate\Support\Facades\Mail;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::with('roles')->orderBy('name')->get();
        return view('usuarios.index', compact('usuarios'));
    }

    public function show(User $usuario)
    {
        $usuario->load('roles');
        $hermano = \App\Models\Hermano::where('dni', $usuario->dni)->first();
        return view('usuarios.show', compact('usuario', 'hermano'));
    }

    public function edit(User $usuario)
    {
        $roles = Role::all();
        $usuario->load('roles');
        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$usuario->id,
            'dni'  => 'required|string|size:9|unique:users,dni,'.$usuario->id,
            'rol'  => 'required|exists:roles,name',
        ]);

        $usuario->update([
            'name'  => $request->name,
            'email' => $request->email,
            'dni'   => strtoupper($request->dni),
        ]);

        $usuario->syncRoles([$request->rol]);

        AuditoriaService::registrar('editar', 'User', $usuario->id,
            "Usuario {$usuario->name} editado. Rol asignado: {$request->rol}.");

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    public function toggleActivo(User $usuario)
    {
        // Evitar que el admin se desactive a sí mismo
        if ($usuario->id === auth()->id()) {
            return back()->with('error', 'No puedes desactivarte a ti mismo.');
        }

        $usuario->activo = !$usuario->activo;
        $usuario->save();

        // Sincronizar con hermano si existe
        $hermano = \App\Models\Hermano::where('dni', $usuario->dni)->first();
        if ($hermano) {
            $hermano->activo = $usuario->activo;
            $hermano->save();
        }

        $accion = $usuario->activo ? 'alta' : 'baja';

        AuditoriaService::registrar($accion, 'User', $usuario->id,
            "Usuario {$usuario->name} dado de {$accion}.");

        Mail::to($usuario->email)->send(new AvisoAltaBajaMail($usuario, $accion));

        return redirect()->route('usuarios.index')
            ->with('success', "Usuario dado de {$accion} correctamente.");
    }
}