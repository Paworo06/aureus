@extends('layouts.app')
@section('titulo', 'Hermanos y Usuarios')
@section('content')

<div class="page-header">
    <h1>Gestión de <span>Hermanos</span></h1>
    <div style="display:flex; gap:0.5rem;">
        @role('administrador|tesorero')
        <a href="{{ route('hermanos.export') }}" class="btn btn-success">
            Exportar Excel
        </a>
        @endrole
        @role('administrador|secretario')
        <a href="{{ route('hermanos.create') }}" class="btn btn-naranja">
            + Nuevo hermano
        </a>
        @endrole
    </div>
</div>

<div class="card">
    <div style="display:flex; gap:0.75rem; margin-bottom:1.2rem; flex-wrap:wrap;">
        <input type="text"
               id="buscador"
               placeholder="Buscar por nombre, apellido o DNI..."
               style="flex:1; min-width:200px; padding:0.5rem 0.85rem;
                      border:1px solid #bdc3c7; border-radius:4px; font-size:13px;">
        <select id="filtroEstado"
                style="padding:0.5rem 0.85rem; border:1px solid #bdc3c7;
                       border-radius:4px; font-size:13px;">
            <option value="">Todos los estados</option>
            <option value="activo">Activos</option>
            <option value="baja">Bajas</option>
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
                    <th>Nombre completo</th>
                    <th>DNI</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Rol</th>
                    <th>Estado pago</th>
                    <th>Estado cuenta</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tablaHermanos">
                @forelse($hermanos as $hermano)
                <tr data-nombre="{{ strtolower($hermano->nombre_completo) }}"
                    data-dni="{{ strtolower($hermano->dni) }}"
                    data-estado="{{ $hermano->activo ? 'activo' : 'baja' }}">
                    <td>{{ $hermano->nombre_completo }}</td>
                    <td>{{ $hermano->dni }}</td>
                    <td>{{ $hermano->user?->email ?? '—' }}</td>
                    <td>{{ $hermano->telefono ?? '—' }}</td>
                    <td>
                        <span class="badge badge-info">
                            {{ $hermano->user?->roles->first()?->name ?? 'sin rol' }}
                        </span>
                    </td>
                    <td>
                        @if($hermano->planPago)
                            @if($hermano->planPago->estado === 'al_dia')
                                <span class="badge badge-success">Al día</span>
                            @elseif($hermano->planPago->estado === 'pendiente')
                                <span class="badge badge-warning">Pendiente</span>
                            @else
                                <span class="badge badge-danger">En mora</span>
                            @endif
                        @else
                            <span class="badge badge-info">Sin plan</span>
                        @endif
                    </td>
                    <td>
                        @if($hermano->activo)
                            <span class="badge badge-success">Activo</span>
                        @else
                            <span class="badge badge-danger">Baja</span>
                        @endif
                    </td>
                    <td style="display:flex; gap:0.4rem; flex-wrap:wrap;">
                        <a href="{{ route('hermanos.show', $hermano) }}"
                           class="btn btn-secondary btn-sm">Ver</a>
                        <a href="{{ route('hermanos.edit', $hermano) }}"
                           class="btn btn-primary btn-sm">Editar</a>
                        @if($hermano->user)
                        @role('administrador')
                        <a href="{{ route('usuarios.edit', $hermano->user) }}"
                           class="btn btn-naranja btn-sm">Rol</a>
                        @endrole
                        @endif
                        @role('administrador')
                        <form method="POST"
                              action="{{ route('usuarios.toggle', $hermano->user) }}"
                              style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-sm
                                {{ $hermano->activo ? 'btn-danger' : 'btn-success' }}">
                                {{ $hermano->activo ? 'Dar de baja' : 'Dar de alta' }}
                            </button>
                        </form>
                        @endrole
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align:center; color:#7f8c8d;">
                        No hay hermanos registrados.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <p id="sinResultadosFiltro"
           style="display:none; text-align:center; color:#7f8c8d; padding:1.5rem;">
            No se encontraron hermanos con ese criterio.
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
        const filas  = document.querySelectorAll('#tablaHermanos tr[data-nombre]');
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