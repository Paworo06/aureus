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

        .header h1 {
            font-size: 28px;
            letter-spacing: 2px;
        }

        .header h1 span { color: #D4622A; }

        .header p { font-size: 11px; opacity: 0.8; margin-top: 3px; }

        .header-right h2 {
            font-size: 18px;
            color: #D4622A;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .header-right p { font-size: 11px; opacity: 0.8; margin-top: 4px; }

        .body { padding: 35px 40px; }

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

        .datos-grid {
            display: table;
            width: 100%;
        }

        .dato {
            display: table-row;
        }

        .dato-label {
            display: table-cell;
            font-weight: bold;
            color: #2E4057;
            width: 35%;
            padding: 5px 0;
        }

        .dato-valor {
            display: table-cell;
            padding: 5px 0;
        }

        .importe-box {
            background: #2E4057;
            color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            margin: 25px 0;
        }

        .importe-box .label {
            font-size: 11px;
            opacity: 0.8;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .importe-box .cantidad {
            font-size: 36px;
            font-weight: bold;
            color: #D4622A;
            margin-top: 5px;
        }

        .footer {
            margin-top: 40px;
            padding-top: 15px;
            border-top: 1px solid #eee;
            text-align: center;
            font-size: 10px;
            color: #aaa;
        }

        .firma {
            display: table;
            width: 100%;
            margin-top: 40px;
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
    </style>
</head>
<body>

<div class="header">
    <div class="header-left">
        <h1>Au<span>reus</span></h1>
        <p>Gestión de Hermandades</p>
    </div>
    <div class="header-right">
        <h2>Recibo de Pago</h2>
        <p>Nº {{ str_pad($pago->id, 6, '0', STR_PAD_LEFT) }}</p>
        <p>{{ $pago->fecha_pago->format('d/m/Y') }}</p>
    </div>
</div>

<div class="body">

    <div class="seccion-titulo">Datos del hermano</div>
    <div class="datos-grid">
        <div class="dato">
            <div class="dato-label">Nombre completo</div>
            <div class="dato-valor">{{ $pago->hermano->nombre_completo }}</div>
        </div>
        <div class="dato">
            <div class="dato-label">DNI</div>
            <div class="dato-valor">{{ $pago->hermano->dni }}</div>
        </div>
    </div>

    <div class="importe-box">
        <div class="label">Importe abonado</div>
        <div class="cantidad">{{ number_format($pago->importe, 2) }} €</div>
    </div>

    <div class="seccion-titulo">Detalle del pago</div>
    <div class="datos-grid">
        <div class="dato">
            <div class="dato-label">Concepto</div>
            <div class="dato-valor">{{ $pago->concepto }}</div>
        </div>
        <div class="dato">
            <div class="dato-label">Fecha de pago</div>
            <div class="dato-valor">{{ $pago->fecha_pago->format('d/m/Y') }}</div>
        </div>
        <div class="dato">
            <div class="dato-label">Registrado por</div>
            <div class="dato-valor">{{ $pago->user->name }}</div>
        </div>
        @if($pago->hermano->planPago)
        <div class="dato">
            <div class="dato-label">Importe pendiente</div>
            <div class="dato-valor">
                {{ number_format($pago->hermano->planPago->importe_pendiente, 2) }} €
            </div>
        </div>
        <div class="dato">
            <div class="dato-label">Cuotas restantes</div>
            <div class="dato-valor">
                {{ $pago->hermano->planPago->cuotas_pendientes }}
            </div>
        </div>
        @endif
    </div>

    <div class="firma">
        <div class="firma-box">
            <div class="firma-linea">Firma del tesorero</div>
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