<?php

namespace App\Http\Controllers;

use App\Models\PlanPago;
use App\Models\Hermano;
use App\Services\AuditoriaService;
use Illuminate\Http\Request;

class PlanPagoController extends Controller
{
    public function create()
    {
        return view('plan-pagos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'hermano_id'     => 'required|exists:hermanos,id',
            'importe_total'  => 'required|numeric|min:0.01',
            'cuotas_totales' => 'required|integer|min:1',
            'periodicidad'   => 'required|in:mensual,trimestral,anual,unica',
            'fecha_inicio'   => 'required|date',
        ]);

        $plan = PlanPago::create($data);

        AuditoriaService::registrar('crear', 'PlanPago', $plan->id,
            "Plan de pago asignado al hermano ID {$data['hermano_id']}.");

        return redirect()->route('hermanos.show', $data['hermano_id'])
            ->with('success', 'Plan de pago asignado correctamente.');
    }

    public function edit(PlanPago $planPago)
    {
        $planPago->load('hermano');
        return view('plan-pagos.edit', compact('planPago'));
    }

    public function update(Request $request, PlanPago $planPago)
    {
        $data = $request->validate([
            'importe_total'  => 'required|numeric|min:0.01',
            'cuotas_totales' => 'required|integer|min:1',
            'periodicidad'   => 'required|in:mensual,trimestral,anual,unica',
            'fecha_inicio'   => 'required|date',
        ]);

        $planPago->update($data);

        AuditoriaService::registrar('editar', 'PlanPago', $planPago->id,
            "Plan de pago del hermano ID {$planPago->hermano_id} editado.");

        return redirect()->route('hermanos.show', $planPago->hermano_id)
            ->with('success', 'Plan de pago actualizado correctamente.');
    }

    public function destroy(PlanPago $planPago)
    {
        $planPago->activo = false;
        $planPago->save();

        AuditoriaService::registrar('baja', 'PlanPago', $planPago->id,
            "Plan de pago del hermano ID {$planPago->hermano_id} desactivado.");

        return redirect()->route('hermanos.show', $planPago->hermano_id)
            ->with('success', 'Plan de pago desactivado.');
    }
}