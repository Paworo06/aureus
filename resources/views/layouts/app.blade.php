<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aureus — @yield('titulo', 'Gestión de Hermandades')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --azul:   #2E4057;
            --naranja:#D4622A;
            --gris:   #555555;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #F4F6F8;
            color: var(--gris);
            min-height: 100vh;
        }

        /* NAVBAR */
        .navbar {
            background: var(--azul);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            height: 60px;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }

        .navbar-brand {
            color: white;
            font-size: 1.4rem;
            font-weight: 700;
            text-decoration: none;
            letter-spacing: 1px;
        }

        .navbar-brand span { color: var(--naranja); }

        .navbar-links {
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .navbar-links a {
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            padding: 0.4rem 0.9rem;
            border-radius: 6px;
            font-size: 0.9rem;
            transition: background 0.2s;
        }

        .navbar-links a:hover,
        .navbar-links a.active {
            background: rgba(255,255,255,0.15);
            color: white;
        }

        .navbar-user {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: rgba(255,255,255,0.85);
            font-size: 0.85rem;
        }

        .btn-logout {
            background: var(--naranja);
            color: white !important;
            padding: 0.35rem 0.9rem !important;
            border-radius: 6px !important;
            font-size: 0.85rem;
        }

        .btn-logout:hover { background: #b8531f !important; }

        /* CONTENIDO */
        .main-content {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1.5rem;
        }

        /* TARJETAS */
        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--azul);
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--naranja);
            display: inline-block;
        }

        /* BOTONES */
        .btn {
            display: inline-block;
            padding: 0.45rem 1.1rem;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: opacity 0.2s;
        }

        .btn:hover { opacity: 0.85; }
        .btn-primary   { background: var(--azul);    color: white; }
        .btn-naranja   { background: var(--naranja);  color: white; }
        .btn-danger    { background: #e74c3c;          color: white; }
        .btn-success   { background: #27ae60;          color: white; }
        .btn-secondary { background: #95a5a6;          color: white; }
        .btn-sm        { padding: 0.3rem 0.7rem; font-size: 0.8rem; }

        /* TABLAS */
        .table-wrapper { overflow-x: auto; }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        thead th {
            background: var(--azul);
            color: white;
            padding: 0.75rem 1rem;
            text-align: left;
            font-weight: 600;
        }

        tbody tr { border-bottom: 1px solid #eee; transition: background 0.15s; }
        tbody tr:hover { background: #f9f9f9; }
        tbody td { padding: 0.7rem 1rem; }

        /* FORMULARIOS */
        .form-group { margin-bottom: 1.1rem; }

        .form-group label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--azul);
            margin-bottom: 0.35rem;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.55rem 0.85rem;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 0.9rem;
            transition: border-color 0.2s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--azul);
        }

        .form-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .form-grid-3 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 1rem;
        }

        /* ALERTAS */
        .alert {
            padding: 0.85rem 1.2rem;
            border-radius: 8px;
            margin-bottom: 1.2rem;
            font-size: 0.9rem;
        }

        .alert-success { background: #d4edda; color: #155724; border-left: 4px solid #27ae60; }
        .alert-error   { background: #f8d7da; color: #721c24; border-left: 4px solid #e74c3c; }
        .alert-warning { background: #fff3cd; color: #856404; border-left: 4px solid #f39c12; }

        /* BADGES */
        .badge {
            display: inline-block;
            padding: 0.25rem 0.6rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-success  { background: #d4edda; color: #155724; }
        .badge-danger   { background: #f8d7da; color: #721c24; }
        .badge-warning  { background: #fff3cd; color: #856404; }
        .badge-info     { background: #d1ecf1; color: #0c5460; }

        /* PÁGINA TÍTULO */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .page-header h1 {
            font-size: 1.5rem;
            color: var(--azul);
            font-weight: 700;
        }

        .page-header h1 span {
            color: var(--naranja);
        }

        /* STATS CARDS */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 1.2rem 1.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            border-left: 4px solid var(--naranja);
        }

        .stat-card .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--azul);
        }

        .stat-card .stat-label {
            font-size: 0.85rem;
            color: var(--gris);
            margin-top: 0.2rem;
        }

        /* ERRORES VALIDACIÓN */
        .error-text {
            color: #e74c3c;
            font-size: 0.8rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar">
    <a href="{{ route('dashboard') }}" class="navbar-brand">
        Au<span>reus</span>
    </a>

    <div class="navbar-links">
        <a href="{{ route('dashboard') }}"
           class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            Dashboard
        </a>

        <a href="{{ route('mosaico') }}"
           class="{{ request()->routeIs('mosaico') ? 'active' : '' }}">
            Mosaico
        </a>

        @role('administrador|secretario')
        <a href="{{ route('hermanos.index') }}"
           class="{{ request()->routeIs('hermanos.*') ? 'active' : '' }}">
            Hermanos
        </a>
        @endrole

        @role('administrador|tesorero')
        <a href="{{ route('pagos.index') }}"
           class="{{ request()->routeIs('pagos.*') ? 'active' : '' }}">
            Pagos
        </a>
        @endrole

        @role('administrador')
        <a href="{{ route('usuarios.index') }}"
           class="{{ request()->routeIs('usuarios.*') ? 'active' : '' }}">
            Usuarios
        </a>
        
        <a href="{{ route('auditoria.index') }}"
           class="{{ request()->routeIs('auditoria.*') ? 'active' : '' }}">
            Auditoría
        </a>
        @endrole
    </div>

    <div class="navbar-user">
        <span>{{ auth()->user()->name }}</span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-logout">Cerrar sesión</button>
        </form>
    </div>
</nav>

{{-- CONTENIDO --}}
<main class="main-content">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    @yield('content')
</main>

</body>
</html>