@extends('layouts.app')
@section('titulo', 'Editar Usuario')
@section('content')

<div class="page-header">
    <h1>Editar <span>Usuario</span></h1>
    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">← Volver</a>
</div>

<div class="card">
    <form method="POST" action="{{ route('usuarios.update', $usuario) }}">
        @csrf @method('PUT')

        <div class="form-grid-2">
            <div class="form-group">
                <label>Nombre completo</label>
                <input type="text" name="name"
                       value="{{ old('name', $usuario->name) }}" required>
                @error('name')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>DNI</label>
                <input type="text" name="dni"
                       value="{{ old('dni', $usuario->dni) }}"
                       maxlength="9"
                       style="text-transform:uppercase"
                       required>
                @error('dni')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form-grid-2">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email"
                       value="{{ old('email', $usuario->email) }}" required>
                @error('email')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Rol</label>
                <select name="rol" required>
                    @foreach($roles as $rol)
                        <option value="{{ $rol->name }}"
                            {{ $usuario->roles->first()?->name === $rol->name
                                ? 'selected' : '' }}>
                            {{ ucfirst($rol->name) }}
                        </option>
                    @endforeach
                </select>
                @error('rol')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div style="display:flex; gap:1rem; margin-top:0.5rem;">
            <button type="submit" class="btn btn-naranja">
                Guardar cambios
            </button>
            <a href="{{ route('usuarios.index') }}"
               class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

@endsection