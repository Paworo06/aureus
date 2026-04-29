@extends('layouts.app')
@section('titulo', 'Usuarios')
@section('content')

<div class="page-header">
    <h1>Gestión de <span>Usuarios</span></h1>
</div>

<div class="card">
    <div style="display:flex; gap:0.75rem; margin-bottom:1.2rem; flex-wrap:wrap;">
        <input type="text"
               id="buscador"
               placeholder="Buscar por nombre, email o DNI..."
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

    <p id="contador"
       style="font-size:0.85rem; color:#888; margin-bottom:0.75rem;"></p>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>DNI</th>
                    <th>Rol</th>
                    <th>Es hermano</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tablaUsuarios">
                @forelse($usuarios as $usuario)
                <tr data-nombre="{{ strtolower($usuario->name) }}"
                    data-email="{{ strtolower($usuario->email) }}"
                    data-dni="{{ strtolower($usuario->dni ?? '') }}"
                    data-estado="{{ $usuario->activo ? 'activo' : 'baja' }}">
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->dni ?? '—' }}</td>
                    <td>
                        <span class="badge badge-info">
                            {{ $usuario->roles->first()?->name ?? 'Sin rol' }}
                        </span>
                    </td>
                    <td>
                        @if(\App\Models\Hermano::where('dni', $usuario->dni)->exists())
                            <span class="badge badge-success">Sí</span>
                        @else
                            <span class="badge badge-danger">No</span>
                        @endif
                    </td>
                    <td>
                        @if($usuario->activo)
                            <span class="badge badge-success">Activo</span>
                        @else
                            <span class="badge badge-danger">Baja</span>
                        @endif
                    </td>
                    <td style="display:flex; gap:0.4rem; flex-wrap:wrap;">
                        <a href="{{ route('usuarios.show', $usuario) }}"
                           class="btn btn-secondary btn-sm">Ver</a>
                        <a href="{{ route('usuarios.edit', $usuario) }}"
                           class="btn btn-primary btn-sm">Editar</a>
                        @if($usuario->id !== auth()->id())
                        <form method="POST"
                              action="{{ route('usuarios.toggle', $usuario) }}">
                            @csrf
                            <button type="submit" class="btn btn-sm
                                {{ $usuario->activo ? 'btn-danger' : 'btn-success' }}">
                                {{ $usuario->activo ? 'Dar de baja' : 'Dar de alta' }}
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center; color:#aaa;">
                        No hay usuarios registrados.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <p id="sinResultadosFiltro"
           style="display:none; text-align:center;
                  color:#aaa; padding:1.5rem;">
            No se encontraron usuarios con ese criterio.
        </p>
    </div>
</div>

<script>
    const buscador      = document.getElementById('buscador');
    const filtroEstado  = document.getElementById('filtroEstado');
    const filas         = document.querySelectorAll('#tablaUsuarios tr');
    const contador      = document.getElementById('contador');
    const sinResultados = document.getElementById('sinResultadosFiltro');

    function filtrar() {
        const texto  = buscador.value.toLowerCase().trim();
        const estado = filtroEstado.value;
        let visibles = 0;

        filas.forEach(fila => {
            if (!fila.dataset.nombre) return;

            const coincideTexto = !texto ||
                fila.dataset.nombre.includes(texto) ||
                fila.dataset.email.includes(texto) ||
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