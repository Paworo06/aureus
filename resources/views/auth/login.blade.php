<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aureus — Iniciar sesión</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: Arial, sans-serif;
            min-height: 100vh;
            display: flex;
        }

        /* LADO IZQUIERDO */
        .login-left {
            width: 45%;
            background-color: #2c3e50;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px 40px;
        }

        .login-logo {
            font-size: 52px;
            font-weight: bold;
            color: white;
            letter-spacing: 4px;
            font-family: Georgia, serif;
            margin-bottom: 10px;
        }

        .login-logo span { color: #e67e22; }

        .login-tagline {
            color: #7f8c8d;
            font-size: 13px;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 50px;
        }

        .login-info {
            width: 100%;
            max-width: 300px;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            margin-bottom: 28px;
        }

        .info-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #e67e22;
            margin-top: 5px;
            flex-shrink: 0;
        }

        .info-item p {
            color: #bdc3c7;
            font-size: 13px;
            line-height: 1.6;
        }

        .info-item p strong {
            color: white;
            display: block;
            margin-bottom: 2px;
        }

        /* LADO DERECHO */
        .login-right {
            flex: 1;
            background-color: #f0f2f5;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px 70px;
        }

        .login-right h2 {
            font-size: 26px;
            color: #2c3e50;
            margin-bottom: 6px;
        }

        .login-right h2 span { color: #e67e22; }

        .login-subtitle {
            color: #7f8c8d;
            font-size: 13px;
            margin-bottom: 35px;
        }

        .form-group { margin-bottom: 18px; }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: bold;
            color: #2c3e50;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 6px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            background: white;
            color: #2c3e50;
            transition: border-color 0.2s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #e67e22;
        }

        .error-box {
            background-color: #fadbd8;
            color: #922b21;
            border: 1px solid #f1948a;
            border-radius: 4px;
            padding: 10px 14px;
            font-size: 13px;
            margin-bottom: 18px;
        }

        .btn-login {
            width: 100%;
            padding: 13px;
            background-color: #e67e22;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 8px;
            transition: background-color 0.2s;
        }

        .btn-login:hover { background-color: #d35400; }

        .login-footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 12px;
            color: #95a5a6;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="login-left">
    <div class="login-logo">Au<span>reus</span></div>
    <div class="login-tagline">Gestión de Hermandades</div>

    <div class="login-info">
        <div class="info-item">
            <div class="info-dot"></div>
            <p>
                <strong>Control de hermanos</strong>
                Gestiona altas, bajas y datos de todos los miembros desde un solo lugar.
            </p>
        </div>
        <div class="info-item">
            <div class="info-dot"></div>
            <p>
                <strong>Gestión económica</strong>
                Seguimiento de cuotas, pagos y generación automática de recibos en PDF.
            </p>
        </div>
        <div class="info-item">
            <div class="info-dot"></div>
            <p>
                <strong>Mosaico interactivo</strong>
                Visualiza el estado de pago de cada hermano de un solo vistazo.
            </p>
        </div>
        <div class="info-item">
            <div class="info-dot"></div>
            <p>
                <strong>Acceso por roles</strong>
                Administrador, Secretario, Tesorero y Usuario con permisos diferenciados.
            </p>
        </div>
    </div>
</div>

<div class="login-right">
    <h2>Bienvenido a <span>Aureus</span></h2>
    <p class="login-subtitle">Introduce tus credenciales para acceder al panel</p>

    @if($errors->any())
    <div class="error-box">{{ $errors->first() }}</div>
    @endif

    @if(session('error'))
    <div class="error-box">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email"
                   value="{{ old('email') }}"
                   placeholder="tu@email.com"
                   autofocus required>
        </div>

        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="password"
                   placeholder="••••••••"
                   required>
        </div>

        <button type="submit" class="btn-login">
            Entrar
        </button>
    </form>

    <div class="login-footer">
        Para obtener acceso contacta con el administrador de tu hermandad.
    </div>
</div>

</body>
</html>