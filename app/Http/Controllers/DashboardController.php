<?php

namespace App\Http\Controllers;

use App\Models\Hermano;
use App\Models\Pago;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('administrador') || $user->hasRole('tesorero')) {
            $totalHermanos    = Hermano::count();
            $hermanosMora     = Hermano::whereHas('planPago', fn($q) =>
                                    $q->whereColumn('importe_pagado', '<', 'importe_total')
                                )->count();
            $recaudado        = Pago::sum('importe');
            $ultimosPagos     = Pago::with('hermano')->latest()->take(5)->get();

            return view('dashboard', compact(
                'totalHermanos', 'hermanosMora', 'recaudado', 'ultimosPagos'
            ));
        }

        // Usuario normal — comprobar si es hermano
        $hermano = Hermano::where('dni', $user->dni)->first();

        if (!$hermano) {
            return view('no_existe_hermano');
        }

        return view('dashboard', compact('hermano'));
    }
}