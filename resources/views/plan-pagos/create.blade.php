@extends('layouts.app')
@section('titulo', 'Asignar Plan de Pago')
@section('content')

<div class="page-header">
    <h1>Asignar <span>Plan de Pago</span></h1>
    <a href="{{ route('hermanos.index') }}" class="btn btn-secondary">← Volver</a>
</div>

<div class="card">
    <form method="POST" action="{{ route('plan-pagos.store') }}">
        @csrf

        <input type="hidden" name="hermano_id"
               value="{{ request('hermano_id') }}">

        @if(request('hermano_id'))
            @php
                $hermano = \App\Models\Hermano::find(request('hermano_id'));
            @endphp
            @if($hermano)
            <div class="alert alert-info" style="background:#d1ecf1;
                color:#0c5460; border-left:4px solid #17a2b8;
                margin-bottom:1rem;">
                Asignando plan de pago a:
                <strong>{{ $hermano->nombre_completo }}</strong>
                — {{ $hermano->dni }}
            </div>
            @endif
        @else
        <div class="form-group">
            <label>Hermano</label>
            <select name="hermano_id" required>
                <option value="">Selecciona un hermano...</option>
                @foreach(\App\Models\Hermano::where('activo', true)
                    ->whereDoesntHave('planPago', fn($q) => $q->where('activo', true))
                    ->orderBy('apellido1')->get() as $h)
                    <option value="{{ $h->id }}"
                        {{ old('hermano_id') == $h->id ? 'selected' : '' }}>
                        {{ $h->nombre_completo }} — {{ $h->dni }}
                    </option>
                @endforeach
            </select>
            @error('hermano_id')
                <p class="error-text">{{ $message }}</p>
            @enderror
        </div>
        @endif

        <div class="form-grid-2">
            <div class="form-group">
                <label>Importe total (€)</label>
                <input type="number" name="importe_total"
                       step="0.01" min="0.01"
                       value="{{ old('importe_total') }}" required>
                @error('importe_total')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Número de cuotas</label>
                <input type="number" name="cuotas_totales"
                       min="1" value="{{ old('cuotas_totales', 1) }}" required>
                @error('cuotas_totales')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form-grid-2">
            <div class="form-group">
                <label>Periodicidad</label>
                <select name="periodicidad" required>
                    <option value="mensual"
                        {{ old('periodicidad') == 'mensual' ? 'selected' : '' }}>
                        Mensual
                    </option>
                    <option value="trimestral"
                        {{ old('periodicidad') == 'trimestral' ? 'selected' : '' }}>
                        Trimestral
                    </option>
                    <option value="anual"
                        {{ old('periodicidad') == 'anual' ? 'selected' : '' }}>
                        Anual
                    </option>
                    <option value="unica"
                        {{ old('periodicidad') == 'unica' ? 'selected' : '' }}>
                        Pago único
                    </option>
                </select>
                @error('periodicidad')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Fecha de inicio</label>
                <input type="date" name="fecha_inicio"
                       value="{{ old('fecha_inicio', date('Y-m-d')) }}" required>
                @error('fecha_inicio')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div style="display:flex; gap:1rem; margin-top:0.5rem;">
            <button type="submit" class="btn btn-naranja">
                Guardar plan de pago
            </button>
            <a href="{{ route('hermanos.index') }}"
               class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

@endsection