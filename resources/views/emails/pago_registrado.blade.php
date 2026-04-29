<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #F4F6F8;
            margin: 0; padding: 0;
        }
        .wrapper {
            max-width: 600px;
            margin: 30px auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        .header {
            background: #2E4057;
            padding: 30px 40px;
            text-align: center;
        }
        .header h1 {
            color: white;
            font-size: 28px;
            letter-spacing: 2px;
            margin: 0;
        }
        .header h1 span { color: #D4622A; }
        .header p {
            color: rgba(255,255,255,0.7);
            font-size: 12px;
            margin-top: 5px;
        }
        .body { padding: 35px 40px; color: #333; }
        .body h2 { color: #2E4057; font-size: 20px; margin-bottom: 15px; }
        .body p {
            font-size: 14px;
            line-height: 1.7;
            color: #555;
            margin-bottom: 12px;
        }
        .importe-box {
            background: #2E4057;
            color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            margin: 20px 0;
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
        .dato-box {
            background: #F4F6F8;
            border-left: 4px solid #D4622A;
            padding: 15px 20px;
            border-radius: 0 8px 8px 0;
            margin: 20px 0;
        }
        .dato-box p { margin: 5px 0; font-size: 13px; }
        .footer {
            background: #F4F6F8;
            padding: 20px 40px;
            text-align: center;
            font-size: 11px;
            color: #aaa;
            border-top: 1px solid #eee;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="header">
        <h1>Au<span>reus</span></h1>
        <p>Gestión de Hermandades</p>
    </div>
    <div class="body">
        <h2>Confirmación de pago</h2>
        <p>Hola <strong>{{ $pago->hermano->nombre_completo }}</strong>,
           te confirmamos que se ha registrado el siguiente pago:</p>

        <div class="importe-box">
            <div class="label">Importe abonado</div>
            <div class="cantidad">{{ number_format($pago->importe, 2) }} €</div>
        </div>

        <div class="dato-box">
            <p><strong>Concepto:</strong> {{ $pago->concepto }}</p>
            <p><strong>Fecha:</strong> {{ $pago->fecha_pago->format('d/m/Y') }}</p>
            <p><strong>Registrado por:</strong> {{ $pago->user->name }}</p>
            @if($pago->hermano->planPago)
            <p><strong>Importe pendiente:</strong>
                {{ number_format($pago->hermano->planPago->importe_pendiente, 2) }} €
            </p>
            <p><strong>Cuotas restantes:</strong>
                {{ $pago->hermano->planPago->cuotas_pendientes }}
            </p>
            @endif
        </div>

        <p>Si tienes alguna duda sobre este pago contacta con
           el administrador de la hermandad.</p>
    </div>
    <div class="footer">
        Este correo ha sido generado automáticamente por Aureus.<br>
        Por favor no respondas a este mensaje.
    </div>
</div>
</body>
</html>