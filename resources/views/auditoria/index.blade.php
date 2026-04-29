@extends('layouts.app')
@section('titulo', 'Auditoría')
@section('content')

<div class="page-header">
    <h1>Registro de <span>Auditoría</span></h1>
</div>

<div class="card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Usuario</th>
                    <th>Operación</th>
                    <th>Modelo</th>
                    <th>ID</th>
                    <th>Detalle</th>
                </tr>
            </thead>
            <tbody>
                @forelse($registros as $registro)
                <tr>
                    <td>{{ $registro->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $registro->user->name }}</td>
                    <td>
                        @php
                            $colores = [
                                'crear'  => 'badge-success',
                                'editar' => 'badge-info',
                                'baja'   => 'badge-danger',
                                'alta'   => 'badge-success',
                                'pago'   => 'badge-warning',
                            ];
                            $clase = $colores[$registro->operacion] ?? 'badge-info';
                        @endphp
                        <span class="badge {{ $clase }}">
                            {{ ucfirst($registro->operacion) }}
                        </span>
                    </td>
                    <td>{{ $registro->modelo }}</td>
                    <td>{{ $registro->modelo_id ?? '—' }}</td>
                    <td style="font-size:0.85rem; color:var(--gris);">
                        {{ $registro->detalle ?? '—' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center; color:#aaa;">
                        No hay registros de auditoría.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div style="margin-top:1rem;">
        {{ $registros->links() }}
    </div>
</div>

@endsection