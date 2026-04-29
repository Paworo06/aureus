<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: DejaVu Sans, sans-serif;
            color: #333;
            font-size: 13px;
        }

        .header {
            background: #2E4057;
            color: white;
            padding: 25px 40px;
            display: table;
            width: 100%;
        }

        .header-left  { display: table-cell; vertical-align: middle; }
        .header-right {
            display: table-cell;
            text-align: right;
            vertical-align: middle;
        }

        .header h1 { font-size: 28px; letter-spacing: 2px; }
        .header h1 span { color: #D4622A; }
        .header p { font-size: 11px; opacity: 0.8; margin-top: 3px; }

        .header-right h2 {
            font-size: 16px;
            color: #D4622A;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .header-right p { font-size: 11px; opacity: 0.8; margin-top: 4px; }

        .body { padding: 35px 40px; }

        .certificado-texto {
            font-size: 14px;
            line-height: 1.8;
            text-align: justify;
            margin: 30px 0;
            padding: 25px;
            border-left: 4px solid #D4622A;
            background: #f9f9f9;
            border-radius: 0 8px 8px 0;
        }

        .seccion-titulo {
            font-size: 11px;
            font-weight: bold;
            color: #2E4057;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 2px solid #D4622A;
            padding-bottom: 4px;
            margin-bottom: 12px;
            margin-top: 25px;
        }

        .datos-grid { display: table; width: 100%; }

        .dato { display: table-row; }

        .dato-label {
            display: table-cell;
            font-weight: bold;
            color: #2E4057;
            width: 35%;
            padding: 5px 0;
        }

        .dato-valor { display: table-cell; padding: 5px 0; }

        .estado-box {
            display: table;
            width: 100%;
            margin: 20px 0;
        }

        .estado-item {
            display: table-cell;
            text-align: center;
            padding: 15px;
            background: #f4f6f8;
            border-radius: 8px;
        }

        .estado-item + .estado-item { margin-left: 10px; }

        .estado-numero {
            font-size: 22px;
            font-weight: bold;
            color: #2E4057;
        }

        .estado-label {
            font-size: 10px;
            color: #888;
            text-transform: uppercase;
            margin-top: 3px;
        }

        .firma {
            display: table;
            width: 100%;
            margin-top: 50px;
        }

        .firma-box {
            display: table-cell;
            width: 45%;
            text-align: center;
        }

        .firma-linea {
            border-top: 1px solid #333;
            padding-top: 6px;
            font-size: 11px;
            color: #555;
            margin-top: 40px;
        }

        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #eee;
            text-align: center;
            font-size: 10px;
            color: #aaa;
        }
    </style>
</head>
<body>

<div class="header">
    <div class="header-left">
        <h1>Au<span>reus</span></h1>
        <p>Gestión de Hermandades</p>
    </div>
    <div class="header-right">
        <h2>Certificado de Hermano</h2>
        <p>{{ now()->format('d/m/Y') }}</p>
    </div>
</div>

<div class="body">

    <div class="certificado-texto">
        La presente hermandad <strong>CERTIFICA</strong> que
        <strong>{{ $hermano->nombre_completo }}</strong>,
        con DNI <strong>{{ $hermano->dni }}</strong>,
        figura como hermano activo en los registros de esta hermandad
        @if($hermano->fecha_ingreso)
            desde el <strong>{{ $hermano->fecha_ingreso->format('d/m/Y') }}</strong>
        @endif
        , encontrándose al corriente de sus obligaciones según los datos
        registrados en el sistema a fecha de <strong>{{ now()->format('d/m/Y') }}</strong>.
    </div>

    <div class="seccion-titulo">Datos del hermano</div>
    <div class="datos-grid">
        <div class="dato">
            <div class="dato-label">Nombre completo</div>
            <div class="dato-valor">{{ $hermano->nombre_completo }}</div>
        </div>
        <div class="dato">
            <div class="dato-label">DNI</div>
            <div class="dato-valor">{{ $hermano->dni }}</div>
        </div>
        <div class="dato">
            <div class="dato-label">Teléfono</div>
            <div class="dato-valor">{{ $hermano->telefono ?? '—' }}</div>
        </div>
        <div class="dato">
            <div class="dato-label">Dirección</div>
            <div class="dato-valor">{{ $hermano->direccion ?? '—' }}</div>
        </div>
        <div class="dato">
            <div class="dato-label">Fecha de ingreso</div>
            <div class="dato-valor">
                {{ $hermano->fecha_ingreso?->format('d/m/Y') ?? '—' }}
            </div>
        </div>
    </div>

    @if($hermano->planPago)
    <div class="seccion-titulo">Estado económico</div>
    <div class="estado-box">
        <div class="estado-item">
            <div class="estado-numero">
                {{ number_format($hermano->planPago->importe_total, 2) }}€
            </div>
            <div class="estado-label">Importe total</div>
        </div>
        <div class="estado-item">
            <div class="estado-numero">
                {{ number_format($hermano->planPago->importe_pagado, 2) }}€
            </div>
            <div class="estado-label">Pagado</div>
        </div>
        <div class="estado-item">
            <div class="estado-numero">
                {{ number_format($hermano->planPago->importe_pendiente, 2) }}€
            </div>
            <div class="estado-label">Pendiente</div>
        </div>
        <div class="estado-item">
            <div class="estado-numero">
                {{ $hermano->planPago->cuotas_pendientes }}
            </div>
            <div class="estado-label">Cuotas pendientes</div>
        </div>
    </div>
    @endif

    <div class="firma">
        <div class="firma-box">
            <div class="firma-linea">El Secretario</div>
        </div>
        <div class="firma-box"></div>
        <div class="firma-box">
            <div class="firma-linea">Sello de la hermandad</div>
        </div>
    </div>

    <div class="footer">
        Documento generado automáticamente por Aureus —
        {{ now()->format('d/m/Y H:i') }}
    </div>

</div>
</body>
</html>