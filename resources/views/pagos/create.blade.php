@extends('layouts.app')
@section('titulo', 'Registrar Pago')
@section('content')

<div class="page-header">
    <h1>Registrar <span>Pago</span></h1>
    <a href="{{ route('pagos.index') }}" class="btn btn-secondary">← Volver</a>
</div>

<div class="card">
    <form method="POST" action="{{ route('pagos.store') }}">
        @csrf
        <div class="form-grid-2">
            <div class="form-group">
                <label>Hermano</label>
                <select name="hermano_id" required>
                    <option value="">Selecciona un hermano...</option>
                    @foreach($hermanos as $hermano)
                        <option value="{{ $hermano->id }}"
                            {{ (request('hermano_id') == $hermano->id ||
                                old('hermano_id') == $hermano->id)
                                ? 'selected' : '' }}>
                            {{ $hermano->nombre_completo }} — {{ $hermano->dni }}
                        </option>
                    @endforeach
                </select>
                @error('hermano_id')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Importe (€)</label>
                <input type="number" name="importe" step="0.01" min="0.01"
                       value="{{ old('importe') }}" required>
                @error('importe')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="form-grid-2">
            <div class="form-group">
                <label>Fecha de pago</label>
                <input type="date" name="fecha_pago"
                       value="{{ old('fecha_pago', date('Y-m-d')) }}" required>
                @error('fecha_pago')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Concepto</label>
                <input type="text" name="concepto"
                       value="{{ old('concepto') }}"
                       placeholder="Ej: Cuota anual 2025" required>
                @error('concepto')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div style="display:flex; gap:1rem; margin-top:0.5rem;">
            <button type="submit" class="btn btn-naranja">Registrar pago</button>
            <a href="{{ route('pagos.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

@endsection