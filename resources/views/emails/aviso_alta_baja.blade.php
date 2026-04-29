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
            padding: 30px 40px;
            text-align: center;
        }
        .header h1 {
            font-size: 28px;
            letter-spacing: 2px;
            margin: 0;
        }
        .header h1 span { color: #D4622A; }
        .header p { font-size: 12px; margin-top: 5px; }
        .body { padding: 35px 40px; color: #333; }
        .body h2 { font-size: 20px; margin-bottom: 15px; }
        .body p {
            font-size: 14px;
            line-height: 1.7;
            color: #555;
            margin-bottom: 12px;
        }
        .estado-box {
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            margin: 20px 0;
            font-size: 18px;
            font-weight: bold;
        }
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
    @if($accion === 'alta')
    <div class="header" style="background:#2E4057;">
        <h1 style="color:white;">Au<span>reus</span></h1>
        <p style="color:rgba(255,255,255,0.7);">Gestión de Hermandades</p>
    </div>
    <div class="body">
        <h2 style="color:#27ae60;">✅ Cuenta activada</h2>
        <p>Hola <strong>{{ $user->name }}</strong>,
           tu cuenta en Aureus ha sido <strong>activada</strong>.
           Ya puedes acceder a la plataforma con normalidad.</p>
        <div class="estado-box"
             style="background:#d4edda; color:#155724;">
            Tu cuenta está ACTIVA
        </div>
        <p>Si tienes alguna pregunta contacta con el administrador.</p>
    </div>
    @else
    <div class="header" style="background:#2E4057;">
        <h1 style="color:white;">Au<span>reus</span></h1>
        <p style="color:rgba(255,255,255,0.7);">Gestión de Hermandades</p>
    </div>
    <div class="body">
        <h2 style="color:#e74c3c;">❌ Cuenta desactivada</h2>
        <p>Hola <strong>{{ $user->name }}</strong>,
           tu cuenta en Aureus ha sido <strong>desactivada</strong>.
           No podrás acceder a la plataforma hasta que el administrador
           la reactive.</p>
        <div class="estado-box"
             style="background:#f8d7da; color:#721c24;">
            Tu cuenta está DESACTIVADA
        </div>
        <p>Si crees que esto es un error contacta con el administrador
           de la hermandad.</p>
    </div>
    @endif
    <div class="footer">
        Este correo ha sido generado automáticamente por Aureus.<br>
        Por favor no respondas a este mensaje.
    </div>
</div>
</body>
</html>