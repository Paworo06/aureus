@extends('layouts.app')
@section('titulo', 'Información del Usuario')
@section('content')

<div class="page-header">
    <h1>Usuario: <span>{{ $usuario->name }}</span></h1>
    <div style="display:flex; gap:0.5rem;">
        <a href="{{ route('usuarios.edit', $usuario) }}"
           class="btn btn-primary">Editar</a>
        <a href="{{ route('usuarios.index') }}"
           class="btn btn-secondary">← Volver</a>
    </div>
</div>

<div class="form-grid-2">
    <div class="card">
        <span class="card-title">Datos del usuario</span>
        <p><strong>Nombre:</strong> {{ $usuario->name }}</p>
        <p style="margin-top:0.5rem">
            <strong>Email:</strong> {{ $usuario->email }}</p>
        <p style="margin-top:0.5rem">
            <strong>DNI:</strong> {{ $usuario->dni ?? '—' }}</p>
        <p style="margin-top:0.5rem">
            <strong>Rol:</strong>
            <span class="badge badge-info">
                {{ $usuario->roles->first()?->name ?? 'Sin rol' }}
            </span>
        </p>
        <p style="margin-top:0.5rem">
            <strong>Estado:</strong>
            @if($usuario->activo)
                <span class="badge badge-success">Activo</span>
            @else
                <span class="badge badge-danger">Baja</span>
            @endif
        </p>
        <p style="margin-top:0.5rem">
            <strong>Registrado:</strong>
            {{ $usuario->created_at->format('d/m/Y') }}
        </p>
    </div>

    <div class="card">
        <span class="card-title">Vinculación con hermano</span>
        @if($hermano)
            <p><strong>Nombre completo:</strong>
                {{ $hermano->nombre_completo }}</p>
            <p style="margin-top:0.5rem">
                <strong>DNI:</strong> {{ $hermano->dni }}</p>
            <p style="margin-top:0.5rem">
                <strong>Estado hermano:</strong>
                @if($hermano->activo)
                    <span class="badge badge-success">Activo</span>
                @else
                    <span class="badge badge-danger">Baja</span>
                @endif
            </p>
            <a href="{{ route('hermanos.show', $hermano) }}"
               class="btn btn-primary btn-sm"
               style="margin-top:1rem; display:inline-block;">
                Ver ficha del hermano
            </a>
        @else
            <p style="color:#aaa;">
                Este usuario no está vinculado a ningún hermano.
            </p>
        @endif
    </div>
</div>

@endsection