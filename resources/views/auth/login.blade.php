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
            font-family: 'Segoe UI', sans-serif;
            background: #F4F6F8;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-wrapper {
            width: 100%;
            max-width: 420px;
            padding: 1rem;
        }

        .auth-logo {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .auth-logo h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2E4057;
            letter-spacing: 2px;
        }

        .auth-logo h1 span { color: #D4622A; }

        .auth-logo p {
            color: #888;
            font-size: 0.9rem;
            margin-top: 0.3rem;
        }

        .auth-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            padding: 2rem;
        }

        .form-group { margin-bottom: 1.1rem; }

        .form-group label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #2E4057;
            margin-bottom: 0.35rem;
        }

        .form-group input {
            width: 100%;
            padding: 0.6rem 0.9rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 0.9rem;
            transition: border-color 0.2s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #2E4057;
        }

        .error-text {
            color: #e74c3c;
            font-size: 0.8rem;
            margin-top: 0.25rem;
        }

        .btn-submit {
            width: 100%;
            padding: 0.7rem;
            background: #D4622A;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 0.5rem;
        }

        .btn-submit:hover { background: #b8531f; }

        .auth-footer {
            text-align: center;
            margin-top: 1.2rem;
            font-size: 0.875rem;
            color: #888;
        }

        .auth-footer a {
            color: #D4622A;
            text-decoration: none;
            font-weight: 600;
        }

        .auth-footer a:hover { text-decoration: underline; }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border-left: 4px solid #e74c3c;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
<div class="auth-wrapper">
    <div class="auth-logo">
        <h1>Au<span>reus</span></h1>
        <p>Gestión de Hermandades</p>
    </div>

    <div class="auth-card">
        <h2 style="color:#2E4057; margin-bottom:1.5rem; font-size:1.2rem;">
            Iniciar sesión
        </h2>

        @if($errors->any())
        <div class="alert-error">
            {{ $errors->first() }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert-error">
            {{ session('error') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email"
                       value="{{ old('email') }}"
                       placeholder="tu@email.com"
                       autofocus required>
                @error('email')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="password"
                       placeholder="••••••••" required>
                @error('password')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn-submit">
                Entrar
            </button>
        </form>
    </div>
</div>
</body>
</html>