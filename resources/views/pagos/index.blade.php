@extends('layouts.app')
@section('titulo', 'Gestión de Pagos')
@section('content')

<div class="page-header">
    <h1>Gestión de <span>Pagos</span></h1>
    <div style="display:flex; gap:0.5rem;">
        <a href="{{ route('hermanos.export') }}" class="btn btn-success">
            Exportar Excel
        </a>
    </div>
</div>

<div class="card">
    <div style="display:flex; gap:0.75rem; margin-bottom:1.2rem; flex-wrap:wrap;">
        <input type="text"
               id="buscador"
               placeholder="Buscar por nombre o DNI..."
               style="flex:1; min-width:200px; padding:0.5rem 0.85rem;
                      border:1px solid #bdc3c7; border-radius:4px; font-size:13px;">
        <select id="filtroEstado"
                style="padding:0.5rem 0.85rem; border:1px solid #bdc3c7;
                       border-radius:4px; font-size:13px;">
            <option value="">Todos los estados</option>
            <option value="al_dia">Al día</option>
            <option value="pendiente">Pendiente</option>
            <option value="mora">En mora</option>
            <option value="sin_plan">Sin plan</option>
        </select>
        <button onclick="limpiarFiltros()" class="btn btn-secondary">
            Limpiar
        </button>
    </div>

    <p id="contador" style="font-size:12px; color:#7f8c8d; margin-bottom:0.75rem;"></p>

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
            <tbody id="tablaPagos">
                @forelse($hermanos as $hermano)
                <tr data-nombre="{{ strtolower($hermano->nombre_completo) }}"
                    data-dni="{{ strtolower($hermano->dni) }}"
                    data-estado="{{ $hermano->planPago ? $hermano->planPago->estado : 'sin_plan' }}">
                    <td>{{ $hermano->nombre_completo }}</td>
                    @if($hermano->planPago)
                        <td>{{ number_format($hermano->planPago->importe_total, 2) }}€</td>
                        <td style="color:#27ae60; font-weight:bold;">
                            {{ number_format($hermano->planPago->importe_pagado, 2) }}€
                        </td>
                        <td style="color:#e74c3c; font-weight:bold;">
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
                        <td colspan="4" style="color:#7f8c8d;">Sin plan de pago</td>
                        <td><span class="badge badge-info">Sin plan</span></td>
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
                    <td colspan="7" style="text-align:center; color:#7f8c8d;">
                        No hay hermanos activos.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <p id="sinResultadosFiltro"
           style="display:none; text-align:center; color:#7f8c8d; padding:1.5rem;">
            No se encontraron resultados con ese criterio.
        </p>
    </div>
</div>

<script>
    const buscador      = document.getElementById('buscador');
    const filtroEstado  = document.getElementById('filtroEstado');
    const contador      = document.getElementById('contador');
    const sinResultados = document.getElementById('sinResultadosFiltro');

    function filtrar() {
        const texto  = buscador.value.toLowerCase().trim();
        const estado = filtroEstado.value;
        const filas  = document.querySelectorAll('#tablaPagos tr[data-nombre]');
        let visibles = 0;

        filas.forEach(fila => {
            const coincideTexto = texto === '' ||
                fila.dataset.nombre.indexOf(texto) !== -1 ||
                fila.dataset.dni.indexOf(texto) !== -1;

            const coincideEstado = estado === '' ||
                fila.dataset.estado === estado;

            if (coincideTexto && coincideEstado) {
                fila.style.display = '';
                visibles++;
            } else {
                fila.style.display = 'none';
            }
        });

        contador.textContent = visibles === filas.length
            ? ''
            : `${visibles} resultado${visibles !== 1 ? 's' : ''} encontrado${visibles !== 1 ? 's' : ''}`;

        sinResultados.style.display = visibles === 0 ? 'block' : 'none';
    }

    function limpiarFiltros() {
        buscador.value     = '';
        filtroEstado.value = '';
        filtrar();
        buscador.focus();
    }

    buscador.addEventListener('input', filtrar);
    filtroEstado.addEventListener('change', filtrar);
</script>

@endsection
