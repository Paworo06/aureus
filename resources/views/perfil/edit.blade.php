@extends('layouts.app')
@section('titulo', 'Mi Perfil')
@section('content')

<div class="page-header">
    <h1>Mi <span>Perfil</span></h1>
</div>

@if($hermano)
<div class="card" style="margin-bottom:1rem;">
    <span class="card-title">Mis datos como hermano</span>
    <div class="form-grid-2" style="margin-top:0.75rem;">
        <div>
            <p><strong>Nombre completo:</strong> {{ $hermano->nombre_completo }}</p>
            <p style="margin-top:0.5rem"><strong>DNI:</strong> {{ $hermano->dni }}</p>
            <p style="margin-top:0.5rem"><strong>Fecha de ingreso:</strong>
                {{ $hermano->fecha_ingreso?->format('d/m/Y') ?? '—' }}</p>
        </div>
        <div>
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
            @else
            <p style="color:#aaa;">Sin plan de pago asignado.</p>
            @endif
        </div>
    </div>
</div>
@endif

<div class="card">
    <span class="card-title">Editar mis datos</span>
    <form method="POST" action="{{ route('perfil.update') }}"
          style="margin-top:0.75rem;">
        @csrf @method('PUT')

        <div class="form-grid-2">
            <div class="form-group">
                <label>Nombre completo</label>
                <input type="text" name="name"
                       value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email"
                       value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>
        </div>

        @if($hermano)
        <div class="form-grid-2">
            <div class="form-group">
                <label>Teléfono</label>
                <input type="text" name="telefono"
                       value="{{ old('telefono', $hermano->telefono) }}">
                @error('telefono')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Dirección</label>
                <input type="text" name="direccion"
                       value="{{ old('direccion', $hermano->direccion) }}">
                @error('direccion')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>
        </div>
        @endif

        <div style="border-top:1px solid #eee; padding-top:1rem; margin-top:0.5rem;">
            <p style="font-size:0.85rem; color:#888; margin-bottom:0.75rem;">
                Deja los campos de contraseña en blanco si no quieres cambiarla.
            </p>
            <div class="form-grid-2">
                <div class="form-group">
                    <label>Nueva contraseña</label>
                    <input type="password" name="password"
                           placeholder="Mínimo 8 caracteres">
                    @error('password')
                        <p class="error-text">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Confirmar contraseña</label>
                    <input type="password" name="password_confirmation"
                           placeholder="Repite la contraseña">
                </div>
            </div>
        </div>

        <div style="display:flex; gap:1rem; margin-top:0.5rem;">
            <button type="submit" class="btn btn-naranja">
                Guardar cambios
            </button>
            <a href="{{ route('dashboard') }}"
               class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

@endsection