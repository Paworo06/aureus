@extends('layouts.app')
@section('titulo', 'Hermanos')
@section('content')

<div class="page-header">
    <h1>Gestión de <span>Hermanos</span></h1>
    <a href="{{ route('hermanos.create') }}" class="btn btn-naranja">+ Nuevo hermano</a>
</div>

<div class="card">
    <div style="display:flex; gap:0.75rem; margin-bottom:1.2rem; flex-wrap:wrap;">
        <input type="text"
               id="buscador"
               placeholder="Buscar por nombre, apellido o DNI..."
               style="flex:1; min-width:200px; padding:0.5rem 0.85rem;
                      border:1px solid #ccc; border-radius:6px; font-size:0.9rem;">
        <select id="filtroEstado"
                style="padding:0.5rem 0.85rem; border:1px solid #ccc;
                       border-radius:6px; font-size:0.9rem;">
            <option value="">Todos los estados</option>
            <option value="activo">Activos</option>
            <option value="baja">Bajas</option>
        </select>
        <button onclick="limpiarFiltros()" class="btn btn-secondary">
            Limpiar
        </button>
    </div>

    <p id="contador" style="font-size:0.85rem; color:#888; margin-bottom:0.75rem;"></p>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Nombre completo</th>
                    <th>DNI</th>
                    <th>Teléfono</th>
                    <th>Fecha ingreso</th>
                    <th>Estado</th>
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
                    <td>{{ $hermano->telefono ?? '—' }}</td>
                    <td>{{ $hermano->fecha_ingreso?->format('d/m/Y') ?? '—' }}</td>
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
                        <form method="POST"
                              action="{{ route('hermanos.destroy', $hermano) }}">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm
                                {{ $hermano->activo ? 'btn-danger' : 'btn-success' }}">
                                {{ $hermano->activo ? 'Dar de baja' : 'Dar de alta' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr id="sinResultados">
                    <td colspan="6" style="text-align:center; color:#aaa;">
                        No hay hermanos registrados.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <p id="sinResultadosFiltro"
           style="display:none; text-align:center;
                  color:#aaa; padding:1.5rem;">
            No se encontraron hermanos con ese criterio.
        </p>
    </div>
</div>

<script>
    const buscador     = document.getElementById('buscador');
    const filtroEstado = document.getElementById('filtroEstado');
    const filas        = document.querySelectorAll('#tablaHermanos tr');
    const contador     = document.getElementById('contador');
    const sinResultados = document.getElementById('sinResultadosFiltro');

    function filtrar() {
        const texto  = buscador.value.toLowerCase().trim();
        const estado = filtroEstado.value;
        let visibles = 0;

        filas.forEach(fila => {
            if (!fila.dataset.nombre) return;

            const coincideTexto = !texto ||
                fila.dataset.nombre.includes(texto) ||
                fila.dataset.dni.includes(texto);

            const coincideEstado = !estado ||
                fila.dataset.estado === estado;

            if (coincideTexto && coincideEstado) {
                fila.style.display = '';
                visibles++;
            } else {
                fila.style.display = 'none';
            }
        });

        // Contador de resultados
        contador.textContent = visibles === filas.length
            ? ''
            : `${visibles} resultado${visibles !== 1 ? 's' : ''} encontrado${visibles !== 1 ? 's' : ''}`;

        // Mensaje sin resultados
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