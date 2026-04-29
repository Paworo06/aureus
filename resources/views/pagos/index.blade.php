@extends('layouts.app')
@section('titulo', 'Gestión de Pagos')
@section('content')

<div class="page-header">
    <h1>Gestión de <span>Pagos</span></h1>
    <a href="{{ route('pagos.create') }}" class="btn btn-naranja">+ Registrar pago</a>
</div>

<div class="card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Hermano</th>
                    <th>Importe total</th>
                    <th>Pagado</th>
                    <th>Pendiente</th>
                    <th>Cuotas</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($hermanos as $hermano)
                <tr>
                    <td>{{ $hermano->nombre_completo }}</td>
                    @if($hermano->planPago)
                        <td>{{ number_format($hermano->planPago->importe_total, 2) }}€</td>
                        <td style="color:#27ae60; font-weight:600;">
                            {{ number_format($hermano->planPago->importe_pagado, 2) }}€
                        </td>
                        <td style="color:#e74c3c; font-weight:600;">
                            {{ number_format($hermano->planPago->importe_pendiente, 2) }}€
                        </td>
                        <td>
                            {{ $hermano->planPago->cuotas_pagadas }} /
                            {{ $hermano->planPago->cuotas_totales }}
                        </td>
                        <td>
                            @if($hermano->planPago->estado === 'al_dia')
                                <span class="badge badge-success">Al día</span>
                            @elseif($hermano->planPago->estado === 'pendiente')
                                <span class="badge badge-warning">Pendiente</span>
                            @else
                                <span class="badge badge-danger">En mora</span>
                            @endif
                        </td>
                    @else
                        <td colspan="4" style="color:#aaa;">Sin plan de pago</td>
                        <td>—</td>
                    @endif
                    <td style="display:flex; gap:0.4rem; flex-wrap:wrap;">
                        <a href="{{ route('pagos.historial', $hermano) }}"
                           class="btn btn-secondary btn-sm">Historial</a>
                        <a href="{{ route('pagos.create') }}?hermano_id={{ $hermano->id }}"
                           class="btn btn-naranja btn-sm">+ Pago</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center; color:#aaa;">
                        No hay hermanos activos.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection