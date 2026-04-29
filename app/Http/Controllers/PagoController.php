<?php

namespace App\Http\Controllers;

use App\Models\Hermano;
use App\Models\Pago;
use App\Models\PlanPago;
use App\Services\AuditoriaService;
use Illuminate\Http\Request;
use App\Mail\PagoRegistradoMail;
use Illuminate\Support\Facades\Mail;

class PagoController extends Controller
{
    public function index()
    {
        $hermanos = Hermano::with('planPago')->where('activo', true)->get();
        return view('pagos.index', compact('hermanos'));
    }

    public function create()
    {
        $hermanos = Hermano::where('activo', true)->orderBy('apellido1')->get();
        return view('pagos.create', compact('hermanos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'hermano_id' => 'required|exists:hermanos,id',
            'importe'    => 'required|numeric|min:0.01',
            'fecha_pago' => 'required|date',
            'concepto'   => 'required|string|max:100',
        ]);

        $data['user_id'] = auth()->id();
        $pago = Pago::create($data);

        // Actualizar plan de pago
        $plan = PlanPago::where('hermano_id', $data['hermano_id'])->first();
        if ($plan) {
            $plan->importe_pagado  += $data['importe'];
            $plan->cuotas_pagadas  += 1;
            $plan->save();
        }

        AuditoriaService::registrar('pago', 'Pago', $pago->id,
            "Pago de {$data['importe']}€ registrado para hermano ID {$data['hermano_id']}.");

        // Cargar relaciones necesarias
        $pago->load('hermano.planPago', 'user');

        // Buscar el usuario vinculado al hermano
        $usuarioHermano = \App\Models\User::where('dni', $pago->hermano->dni)->first();
        if ($usuarioHermano) {
            Mail::to($usuarioHermano->email)->send(new PagoRegistradoMail($pago));
        }

        return redirect()->route('pagos.index')
            ->with('success', 'Pago registrado correctamente.');
    }

    public function show(Pago $pago)
    {
        $pago->load('hermano', 'user');
        return view('pagos.show', compact('pago'));
    }

    public function historial(Hermano $hermano)
    {
        $pagos = $hermano->pagos()->latest()->get();
        return view('pagos.historial', compact('hermano', 'pagos'));
    }
}