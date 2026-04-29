@extends('layouts.app')
@section('titulo', 'Información del Hermano')
@section('content')

<div class="page-header">
    <h1>Hermano: <span>{{ $hermano->nombre_completo }}</span></h1>
    <div style="display:flex; gap:0.5rem;">
        @role('administrador|secretario')
        <a href="{{ route('pdfs.certificado', $hermano) }}"
        class="btn btn-naranja"
        target="_blank">
            📄 Certificado
        </a>
        @endrole
        <a href="{{ route('hermanos.edit', $hermano) }}"
        class="btn btn-primary">Editar</a>
        <a href="{{ route('hermanos.index') }}"
        class="btn btn-secondary">← Volver</a>
    </div>
</div>

<div class="form-grid-2">
    <div class="card">
        <span class="card-title">Datos personales</span>
        <p><strong>DNI:</strong> {{ $hermano->dni }}</p>
        <p style="margin-top:0.5rem"><strong>Teléfono:</strong> {{ $hermano->telefono ?? '—' }}</p>
        <p style="margin-top:0.5rem"><strong>Dirección:</strong> {{ $hermano->direccion ?? '—' }}</p>
        <p style="margin-top:0.5rem"><strong>Fecha de ingreso:</strong>
            {{ $hermano->fecha_ingreso?->format('d/m/Y') ?? '—' }}</p>
        <p style="margin-top:0.5rem"><strong>Estado:</strong>
            @if($hermano->activo)
                <span class="badge badge-success">Activo</span>
            @else
                <span class="badge badge-danger">Baja</span>
            @endif
        </p>
    </div>

    <div class="card">
        <span class="card-title">Plan de pago</span>
        @if($hermano->planPago)
        <p><strong>Importe total:</strong>
            {{ number_format($hermano->planPago->importe_total, 2) }}€</p>
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
        <p style="margin-top:0.5rem"><strong>Cuotas:</strong>
            {{ $hermano->planPago->cuotas_pagadas }} /
            {{ $hermano->planPago->cuotas_totales }}</p>
        <p style="margin-top:0.5rem"><strong>Periodicidad:</strong>
            {{ ucfirst($hermano->planPago->periodicidad) }}</p>
        @else
        <p style="color:#aaa;">Sin plan de pago asignado.</p>
        @role('administrador|tesorero')
        <a href="{{ route('plan-pagos.create', ['hermano_id' => $hermano->id]) }}"
           class="btn btn-naranja btn-sm" style="margin-top:1rem;">
            Asignar plan de pago
        </a>
        @endrole
        @endif
    </div>
</div>

<div class="card">
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <span class="card-title">Últimos pagos</span>
        @role('administrador|tesorero')
        <a href="{{ route('pagos.historial', $hermano) }}"
           class="btn btn-secondary btn-sm">Ver historial completo</a>
        @endrole
    </div>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Concepto</th>
                    <th>Importe</th>
                </tr>
            </thead>
            <tbody>
                @forelse($hermano->pagos->take(5) as $pago)
                <tr>
                    <td>{{ $pago->fecha_pago->format('d/m/Y') }}</td>
                    <td>{{ $pago->concepto }}</td>
                    <td>{{ number_format($pago->importe, 2) }}€</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="text-align:center; color:#aaa;">
                        Sin pagos registrados.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection