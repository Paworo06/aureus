@extends('layouts.app')
@section('titulo', 'Mosaico')
@section('content')

<div class="page-header">
    <h1>Mosaico de <span>Hermanos</span></h1>
</div>

<div class="card">
    <div style="display:flex; gap:1.5rem; margin-bottom:1.5rem; flex-wrap:wrap;">
        <div style="display:flex; align-items:center; gap:0.5rem;">
            <div style="width:16px; height:16px; border-radius:4px;
                        background:#27ae60;"></div>
            <span style="font-size:0.85rem;">Al día</span>
        </div>
        <div style="display:flex; align-items:center; gap:0.5rem;">
            <div style="width:16px; height:16px; border-radius:4px;
                        background:#f39c12;"></div>
            <span style="font-size:0.85rem;">Cuota pendiente</span>
        </div>
        <div style="display:flex; align-items:center; gap:0.5rem;">
            <div style="width:16px; height:16px; border-radius:4px;
                        background:#e74c3c;"></div>
            <span style="font-size:0.85rem;">En mora</span>
        </div>
        <div style="display:flex; align-items:center; gap:0.5rem;">
            <div style="width:16px; height:16px; border-radius:4px;
                        background:#bdc3c7;"></div>
            <span style="font-size:0.85rem;">Sin plan de pago</span>
        </div>
    </div>

    <div style="display:grid;
                grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
                gap:1rem;">
        @forelse($hermanos as $hermano)
            @php
                $color = '#bdc3c7';
                $estado = 'Sin plan';
                if ($hermano->planPago) {
                    if ($hermano->planPago->estado === 'al_dia') {
                        $color  = '#27ae60';
                        $estado = 'Al día';
                    } elseif ($hermano->planPago->estado === 'pendiente') {
                        $color  = '#f39c12';
                        $estado = 'Pendiente';
                    } else {
                        $color  = '#e74c3c';
                        $estado = 'En mora';
                    }
                }
            @endphp

            @role('administrador|secretario|tesorero')
            <a href="{{ route('hermanos.show', $hermano) }}"
               style="text-decoration:none;">
            @endrole

            <div style="background:{{ $color }};
                        border-radius:10px;
                        padding:1rem 0.75rem;
                        text-align:center;
                        cursor:pointer;
                        transition:transform 0.15s, box-shadow 0.15s;
                        box-shadow: 0 2px 6px rgba(0,0,0,0.12);"
                 title="{{ $hermano->nombre_completo }} — {{ $estado }}"
                 onmouseover="this.style.transform='scale(1.05)';
                              this.style.boxShadow='0 4px 12px rgba(0,0,0,0.2)'"
                 onmouseout="this.style.transform='scale(1)';
                             this.style.boxShadow='0 2px 6px rgba(0,0,0,0.12)'">
                <div style="font-weight:700; color:white;
                            font-size:0.85rem; line-height:1.3;">
                    {{ $hermano->nombre }}
                </div>
                <div style="color:rgba(255,255,255,0.85);
                            font-size:0.75rem; margin-top:0.3rem;">
                    {{ $hermano->apellido1 }}
                </div>
                <div style="color:rgba(255,255,255,0.75);
                            font-size:0.7rem; margin-top:0.4rem;
                            background:rgba(0,0,0,0.15);
                            border-radius:4px; padding:0.1rem 0.3rem;">
                    {{ $estado }}
                </div>
            </div>

            @role('administrador|secretario|tesorero')
            </a>
            @endrole

        @empty
            <p style="color:#aaa; grid-column:1/-1; text-align:center;">
                No hay hermanos activos.
            </p>
        @endforelse
    </div>
</div>

@endsection