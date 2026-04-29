@extends('layouts.app')
@section('titulo', 'Historial de Pagos')
@section('content')

<div class="page-header">
    <h1>Historial — <span>{{ $hermano->nombre_completo }}</span></h1>
    <div style="display:flex; gap:0.5rem;">
        <a href="{{ route('pagos.create') }}?hermano_id={{ $hermano->id }}"
           class="btn btn-naranja">+ Registrar pago</a>
        <a href="{{ route('pagos.index') }}" class="btn btn-secondary">← Volver</a>
    </div>
</div>

@if($hermano->planPago)
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-number">
            {{ number_format($hermano->planPago->importe_total, 2) }}€
        </div>
        <div class="stat-label">Importe total</div>
    </div>
    <div class="stat-card" style="border-left-color:#27ae60;">
        <div class="stat-number" style="color:#27ae60;">
            {{ number_format($hermano->planPago->importe_pagado, 2) }}€
        </div>
        <div class="stat-label">Total pagado</div>
    </div>
    <div class="stat-card" style="border-left-color:#e74c3c;">
        <div class="stat-number" style="color:#e74c3c;">
            {{ number_format($hermano->planPago->importe_pendiente, 2) }}€
        </div>
        <div class="stat-label">Pendiente</div>
    </div>
    <div class="stat-card" style="border-left-color:#f39c12;">
        <div class="stat-number" style="color:#f39c12;">
            {{ $hermano->planPago->cuotas_pendientes }}
        </div>
        <div class="stat-label">Cuotas pendientes</div>
    </div>
</div>
@endif

<div class="card">
    <span class="card-title">Pagos realizados</span>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Concepto</th>
                    <th>Importe</th>
                    <th>Registrado por</th>
                    <th>Recibo</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pagos as $pago)
                <tr>
                    <td>{{ $pago->fecha_pago->format('d/m/Y') }}</td>
                    <td>{{ $pago->concepto }}</td>
                    <td style="font-weight:600;">
                        {{ number_format($pago->importe, 2) }}€
                    </td>
                    <td>{{ $pago->user->name }}</td>
                    <td>
                        <a href="{{ route('pdfs.recibo', $pago) }}"
                        class="btn btn-secondary btn-sm"
                        target="_blank">
                            📄 Recibo
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center; color:#aaa;">
                        No hay pagos registrados para este hermano.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection