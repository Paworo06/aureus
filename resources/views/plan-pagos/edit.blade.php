@extends('layouts.app')
@section('titulo', 'Editar Plan de Pago')
@section('content')

<div class="page-header">
    <h1>Editar <span>Plan de Pago</span></h1>
    <a href="{{ route('hermanos.show', $planPago->hermano) }}"
       class="btn btn-secondary">← Volver</a>
</div>

<div class="card">
    <div class="alert alert-info" style="background:#d1ecf1;
        color:#0c5460; border-left:4px solid #17a2b8; margin-bottom:1rem;">
        Editando plan de pago de:
        <strong>{{ $planPago->hermano->nombre_completo }}</strong>
    </div>

    <form method="POST" action="{{ route('plan-pagos.update', $planPago) }}">
        @csrf @method('PUT')

        <div class="form-grid-2">
            <div class="form-group">
                <label>Importe total (€)</label>
                <input type="number" name="importe_total" step="0.01" min="0.01"
                       value="{{ old('importe_total', $planPago->importe_total) }}"
                       required>
                @error('importe_total')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Número de cuotas</label>
                <input type="number" name="cuotas_totales" min="1"
                       value="{{ old('cuotas_totales', $planPago->cuotas_totales) }}"
                       required>
                @error('cuotas_totales')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form-grid-2">
            <div class="form-group">
                <label>Periodicidad</label>
                <select name="periodicidad" required>
                    @foreach(['mensual','trimestral','anual','unica'] as $p)
                    <option value="{{ $p }}"
                        {{ old('periodicidad', $planPago->periodicidad) == $p
                            ? 'selected' : '' }}>
                        {{ ucfirst($p === 'unica' ? 'Pago único' : $p) }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Fecha de inicio</label>
                <input type="date" name="fecha_inicio"
                       value="{{ old('fecha_inicio',
                           $planPago->fecha_inicio->format('Y-m-d')) }}"
                       required>
            </div>
        </div>

        <div style="display:flex; gap:1rem; margin-top:0.5rem;">
            <button type="submit" class="btn btn-naranja">Guardar cambios</button>
            <a href="{{ route('hermanos.show', $planPago->hermano) }}"
               class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

@endsection