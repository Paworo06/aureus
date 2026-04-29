<?php

namespace App\Http\Controllers;

use App\Models\Hermano;
use App\Models\User;
use App\Services\AuditoriaService;
use Illuminate\Http\Request;
use App\Exports\HermanosExport;
use Maatwebsite\Excel\Facades\Excel;

class HermanoController extends Controller
{
    public function index()
    {
        $hermanos = Hermano::orderBy('apellido1')->get();
        return view('hermanos.index', compact('hermanos'));
    }

    public function create()
    {
        return view('hermanos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'        => 'required|string|max:50',
            'apellido1'     => 'required|string|max:50',
            'apellido2'     => 'nullable|string|max:50',
            'dni'           => 'required|string|size:9|unique:hermanos,dni',
            'email'         => 'required|email|unique:users,email',
            'direccion'     => 'nullable|string|max:150',
            'telefono'      => 'nullable|string|max:15',
            'fecha_ingreso' => 'nullable|date',
        ]);

        // Crear hermano
        $hermano = Hermano::create($data);

        // Contraseña inicial = DNI
        $passwordInicial = strtoupper($data['dni']);

        // Crear usuario vinculado
        $usuario = User::create([
            'name'     => "{$data['nombre']} {$data['apellido1']}",
            'dni'      => strtoupper($data['dni']),
            'email'    => $data['email'],
            'password' => \Illuminate\Support\Facades\Hash::make($passwordInicial),
            'activo'   => true,
        ]);

        $usuario->assignRole('usuario');

        // Enviar correo de bienvenida con credenciales
        \Illuminate\Support\Facades\Mail::to($usuario->email)
            ->send(new \App\Mail\BienvenidaHermanMail($usuario, $passwordInicial));

        AuditoriaService::registrar('crear', 'Hermano', $hermano->id,
            "Hermano {$hermano->nombre_completo} creado con usuario vinculado.");

        return redirect()->route('hermanos.index')
            ->with('success', 'Hermano creado correctamente. Se ha enviado un correo con sus credenciales.');
    }

    public function show(Hermano $hermano)
    {
        $hermano->load('planPago', 'pagos');
        return view('hermanos.show', compact('hermano'));
    }

    public function edit(Hermano $hermano)
    {
        return view('hermanos.edit', compact('hermano'));
    }

    public function update(Request $request, Hermano $hermano)
    {
        $data = $request->validate([
            'nombre'        => 'required|string|max:50',
            'apellido1'     => 'required|string|max:50',
            'apellido2'     => 'nullable|string|max:50',
            'dni'           => 'required|string|size:9|unique:hermanos,dni,'.$hermano->id,
            'direccion'     => 'nullable|string|max:150',
            'telefono'      => 'nullable|string|max:15',
            'fecha_ingreso' => 'nullable|date',
        ]);

        $hermano->update($data);

        AuditoriaService::registrar('editar', 'Hermano', $hermano->id,
            "Hermano {$hermano->nombre_completo} editado.");

        return redirect()->route('hermanos.index')
            ->with('success', 'Hermano actualizado correctamente.');
    }

    public function destroy(Hermano $hermano)
    {
        $hermano->activo = !$hermano->activo;
        $hermano->save();

        $accion = $hermano->activo ? 'alta' : 'baja';

        AuditoriaService::registrar($accion, 'Hermano', $hermano->id,
            "Hermano {$hermano->nombre_completo} dado de {$accion}.");

        return redirect()->route('hermanos.index')
            ->with('success', "Hermano dado de {$accion} correctamente.");
    }

    public function export()
    {
        return Excel::download(new HermanosExport, 'hermanos.xlsx');
    }
}