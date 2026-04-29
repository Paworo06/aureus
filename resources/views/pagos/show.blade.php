@extends('layouts.app')
@section('titulo', 'Detalle del Pago')
@section('content')

<div class="page-header">
    <h1>Detalle del <span>Pago</span></h1>
    <a href="{{ route('pagos.index') }}" class="btn btn-secondary">← Volver</a>
</div>

<div class="card">
    <span class="card-title">Información del pago</span>
    <div class="form-grid-2">
        <div>
            <p><strong>Hermano:</strong> {{ $pago->hermano->nombre_completo }}</p>
            <p style="margin-top:0.5rem">
                <strong>DNI:</strong> {{ $pago->hermano->dni }}
            </p>
            <p style="margin-top:0.5rem">
                <strong>Registrado por:</strong> {{ $pago->user->name }}
            </p>
        </div>
        <div>
            <p><strong>Importe:</strong>
                <span style="font-size:1.3rem; font-weight:700; color:#27ae60;">
                    {{ number_format($pago->importe, 2) }}€
                </span>
            </p>
            <p style="margin-top:0.5rem">
                <strong>Fecha:</strong> {{ $pago->fecha_pago->format('d/m/Y') }}
            </p>
            <p style="margin-top:0.5rem">
                <strong>Concepto:</strong> {{ $pago->concepto }}
            </p>
        </div>
    </div>
</div>

@endsection