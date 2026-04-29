@extends('layouts.app')
@section('titulo', 'Nuevo Hermano')
@section('content')

<div class="page-header">
    <h1>Nuevo <span>Hermano</span></h1>
    <a href="{{ route('hermanos.index') }}" class="btn btn-secondary">← Volver</a>
</div>

<div class="card">
    <form method="POST" action="{{ route('hermanos.store') }}">
        @csrf
        <div class="form-grid-3">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}" required>
                @error('nombre')<p class="error-text">{{ $message }}</p>@enderror
            </div>
            <div class="form-group">
                <label>Primer apellido</label>
                <input type="text" name="apellido1" value="{{ old('apellido1') }}" required>
                @error('apellido1')<p class="error-text">{{ $message }}</p>@enderror
            </div>
            <div class="form-group">
                <label>Segundo apellido</label>
                <input type="text" name="apellido2" value="{{ old('apellido2') }}">
            </div>
        </div>
        <div class="form-grid-3">
            <div class="form-group">
                <label>DNI</label>
                <input type="text" name="dni" value="{{ old('dni') }}"
                       maxlength="9" required>
                @error('dni')<p class="error-text">{{ $message }}</p>@enderror
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
                @error('email')<p class="error-text">{{ $message }}</p>@enderror
            </div>
            <div class="form-group">
                <label>Teléfono</label>
                <input type="text" name="telefono" value="{{ old('telefono') }}">
            </div>
            <div class="form-group">
                <label>Fecha de ingreso</label>
                <input type="date" name="fecha_ingreso" value="{{ old('fecha_ingreso') }}">
            </div>
        </div>
        <div class="form-group">
            <label>Dirección</label>
            <input type="text" name="direccion" value="{{ old('direccion') }}">
        </div>
        <div style="display:flex; gap:1rem; margin-top:0.5rem;">
            <button type="submit" class="btn btn-naranja">Guardar hermano</button>
            <a href="{{ route('hermanos.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

@endsection