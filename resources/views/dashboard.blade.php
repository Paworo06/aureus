@extends('layouts.app')

@section('titulo', 'Dashboard')

@section('content')

@role('administrador|tesorero')
<div class="page-header">
    <h1>Panel de <span>Control</span></h1>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-number">{{ $totalHermanos }}</div>
        <div class="stat-label">Hermanos activos</div>
    </div>
    <div class="stat-card" style="border-left-color: #e74c3c;">
        <div class="stat-number" style="color: #e74c3c;">{{ $hermanosMora }}</div>
        <div class="stat-label">Hermanos con cuotas pendientes</div>
    </div>
    <div class="stat-card" style="border-left-color: #27ae60;">
        <div class="stat-number" style="color: #27ae60;">{{ number_format($recaudado, 2) }}€</div>
        <div class="stat-label">Total recaudado</div>
    </div>
</div>

<div class="card">
    <span class="card-title">Últimos pagos registrados</span>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Hermano</th>
                    <th>Importe</th>
                    <th>Concepto</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ultimosPagos as $pago)
                <tr>
                    <td>{{ $pago->hermano->nombre_completo }}</td>
                    <td>{{ number_format($pago->importe, 2) }}€</td>
                    <td>{{ $pago->concepto }}</td>
                    <td>{{ $pago->fecha_pago->format('d/m/Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align:center; color:#aaa;">
                        No hay pagos registrados aún.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@else
{{-- Vista para usuario hermano --}}
<div class="page-header">
    <h1>Bienvenido, <span>{{ auth()->user()->name }}</span></h1>
</div>

<div class="card">
    <span class="card-title">Tus datos como hermano</span>
    <div class="form-grid-2">
        <div>
            <p><strong>Nombre completo:</strong> {{ $hermano->nombre_completo }}</p>
            <p style="margin-top:0.5rem"><strong>DNI:</strong> {{ $hermano->dni }}</p>
            <p style="margin-top:0.5rem"><strong>Teléfono:</strong> {{ $hermano->telefono ?? '—' }}</p>
        </div>
        <div>
            @if($hermano->planPago)
            <p><strong>Importe total:</strong> {{ number_format($hermano->planPago->importe_total, 2) }}€</p>
            <p style="margin-top:0.5rem"><strong>Pagado:</strong>
                <span style="color:#27ae60; font-weight:700;">
                    {{ number_format($hermano->planPago->importe_pagado, 2) }}€
                </span>
            </p>
            <p style="margin-top:0.5rem"><strong>Pendiente:</strong>
                <span style="color:#e74c3c; font-weight:700;">
                    {{ number_format($hermano->planPago->importe_pendiente, 2) }}€
                </span>
            </p>
            <p style="margin-top:0.5rem"><strong>Cuotas restantes:</strong>
                {{ $hermano->planPago->cuotas_pendientes }}
            </p>
            @else
            <p style="color:#aaa;">No tienes un plan de pago asignado aún.</p>
            @endif
        </div>
    </div>
</div>

<div style="text-align:center; margin-top:1rem;">
    <a href="{{ route('mosaico') }}" class="btn btn-primary">Ver mosaico de hermanos</a>
</div>
@endrole

@endsection