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
        .credenciales {
            background: #2E4057;
            border-radius: 8px;
            padding: 20px 25px;
            margin: 20px 0;
        }
        .credenciales p {
            color: white;
            margin: 6px 0;
            font-size: 14px;
        }
        .credenciales span {
            color: #D4622A;
            font-weight: bold;
            font-size: 16px;
        }
        .aviso {
            background: #fff3cd;
            border-left: 4px solid #f39c12;
            padding: 12px 16px;
            border-radius: 0 8px 8px 0;
            font-size: 13px;
            color: #856404;
            margin: 15px 0;
        }
        .btn {
            display: inline-block;
            background: #D4622A;
            color: white;
            padding: 12px 28px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            margin-top: 10px;
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
    <div class="header">
        <h1>Au<span>reus</span></h1>
        <p>Gestión de Hermandades</p>
    </div>
    <div class="body">
        <h2>¡Bienvenido, {{ $user->name }}!</h2>
        <p>Has sido registrado como hermano en <strong>Aureus</strong>.
           A continuación encontrarás tus credenciales de acceso:</p>

        <div class="credenciales">
            <p>📧 <strong>Email:</strong>
                <span>{{ $user->email }}</span>
            </p>
            <p>🔑 <strong>Contraseña inicial:</strong>
                <span>{{ $password }}</span>
            </p>
        </div>

        <div class="aviso">
            ⚠️ Por seguridad te recomendamos cambiar tu contraseña
            la primera vez que accedas a la plataforma.
        </div>

        <p>Con tu cuenta podrás consultar tu información como hermano,
           ver el estado de tus cuotas y acceder al mosaico de la hermandad.</p>

        <a href="{{ url('/') }}" class="btn">Acceder a Aureus</a>
    </div>
    <div class="footer">
        Este correo ha sido generado automáticamente por Aureus.<br>
        Por favor no respondas a este mensaje.
    </div>
</div>
</body>
</html>