<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aureus — @yield('titulo', 'Gestión de Hermandades')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 220px;
            background-color: #2c3e50;
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            display: flex;
            flex-direction: column;
        }

        .sidebar-logo {
            padding: 20px;
            border-bottom: 1px solid #3d5166;
            text-align: center;
        }

        .sidebar-logo h1 {
            color: white;
            font-size: 24px;
            letter-spacing: 2px;
        }

        .sidebar-logo h1 span {
            color: #e67e22;
        }

        .sidebar-logo p {
            color: #7f8c8d;
            font-size: 11px;
            margin-top: 4px;
        }

        .sidebar-user {
            padding: 15px 20px;
            border-bottom: 1px solid #3d5166;
        }

        .sidebar-user p {
            color: white;
            font-size: 13px;
            font-weight: bold;
        }

        .sidebar-user span {
            color: #7f8c8d;
            font-size: 11px;
        }

        .sidebar-nav {
            flex: 1;
            padding: 10px 0;
        }

        .nav-section-title {
            color: #7f8c8d;
            font-size: 10px;
            text-transform: uppercase;
            padding: 10px 20px 4px;
            letter-spacing: 1px;
        }

        .nav-item {
            display: block;
            padding: 10px 20px;
            color: #bdc3c7;
            text-decoration: none;
            font-size: 13px;
        }

        .nav-item:hover {
            background-color: #3d5166;
            color: white;
        }

        .nav-item.active {
            background-color: #e67e22;
            color: white;
        }

        .sidebar-bottom {
            padding: 15px 20px;
            border-top: 1px solid #3d5166;
        }

        .btn-logout {
            background-color: #c0392b;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
            width: 100%;
        }

        .btn-logout:hover {
            background-color: #e74c3c;
        }

        .btn-theme {
            background-color: #3d5166;
            color: #bdc3c7;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
            width: 100%;
            margin-bottom: 8px;
        }

        .btn-theme:hover {
            background-color: #4a6278;
            color: white;
        }

        /* CONTENIDO PRINCIPAL */
        .main-wrapper {
            margin-left: 220px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background-color: white;
            padding: 12px 25px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar h2 {
            color: #2c3e50;
            font-size: 16px;
        }

        .topbar h2 span {
            color: #e67e22;
        }

        .main-content {
            padding: 25px;
            flex: 1;
        }

        /* CARDS */
        .card {
            background-color: white;
            border-radius: 6px;
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 14px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e67e22;
            display: inline-block;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .page-header h1 {
            font-size: 22px;
            color: #2c3e50;
        }

        .page-header h1 span {
            color: #e67e22;
        }

        /* STATS */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        .stat-card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 15px 20px;
            border-left: 4px solid #e67e22;
        }

        .stat-card .stat-number {
            font-size: 28px;
            font-weight: bold;
            color: #2c3e50;
        }

        .stat-card .stat-label {
            font-size: 12px;
            color: #7f8c8d;
            margin-top: 4px;
        }

        /* BOTONES */
        .btn {
            display: inline-block;
            padding: 7px 14px;
            border-radius: 4px;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            border: none;
            text-decoration: none;
        }

        .btn:hover { opacity: 0.85; }
        .btn-primary   { background-color: #2c3e50; color: white; }
        .btn-naranja   { background-color: #e67e22; color: white; }
        .btn-danger    { background-color: #e74c3c; color: white; }
        .btn-success   { background-color: #27ae60; color: white; }
        .btn-secondary { background-color: #95a5a6; color: white; }
        .btn-sm        { padding: 4px 10px; font-size: 12px; }

        /* TABLAS */
        .table-wrapper { overflow-x: auto; }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        thead th {
            background-color: #2c3e50;
            color: white;
            padding: 10px 12px;
            text-align: left;
        }

        tbody tr {
            border-bottom: 1px solid #ecf0f1;
        }

        tbody tr:hover {
            background-color: #f8f9fa;
        }

        tbody td {
            padding: 9px 12px;
        }

        /* FORMULARIOS */
        .form-group { margin-bottom: 15px; }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #bdc3c7;
            border-radius: 4px;
            font-size: 13px;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #e67e22;
        }

        .form-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
        .form-grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px; }

        /* ALERTAS */
        .alert {
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 15px;
            font-size: 13px;
        }

        .alert-success { background-color: #d5f5e3; color: #1e8449; border: 1px solid #a9dfbf; }
        .alert-error   { background-color: #fadbd8; color: #922b21; border: 1px solid #f1948a; }
        .alert-warning { background-color: #fdebd0; color: #9c640c; border: 1px solid #f8c471; }

        /* BADGES */
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 11px;
            font-weight: bold;
        }

        .badge-success { background-color: #d5f5e3; color: #1e8449; }
        .badge-danger  { background-color: #fadbd8; color: #922b21; }
        .badge-warning { background-color: #fdebd0; color: #9c640c; }
        .badge-info    { background-color: #d6eaf8; color: #1a5276; }

        .error-text { color: #e74c3c; font-size: 12px; margin-top: 4px; }

        /* MODO OSCURO */
        body.dark { background-color: #1a1a2e; color: #e0e0e0; }
        body.dark .sidebar { background-color: #16213e; }
        body.dark .sidebar-logo { border-color: #0f3460; }
        body.dark .sidebar-user { border-color: #0f3460; }
        body.dark .nav-item { color: #a0a0b0; }
        body.dark .nav-item:hover { background-color: #0f3460; color: white; }
        body.dark .sidebar-bottom { border-color: #0f3460; }
        body.dark .btn-theme { background-color: #0f3460; }
        body.dark .topbar { background-color: #16213e; border-color: #0f3460; }
        body.dark .topbar h2 { color: #e0e0e0; }
        body.dark .card { background-color: #16213e; border-color: #0f3460; }
        body.dark .card-title { color: #e0e0e0; }
        body.dark .page-header h1 { color: #e0e0e0; }
        body.dark .stat-card { background-color: #16213e; border-color: #0f3460; }
        body.dark .stat-card .stat-number { color: #e0e0e0; }
        body.dark .stat-card .stat-label { color: #a0a0b0; }
        body.dark table thead th { background-color: #0f3460; }
        body.dark tbody tr { border-color: #0f3460; }
        body.dark tbody tr:hover { background-color: #0f3460; }
        body.dark tbody td { color: #e0e0e0; }
        body.dark .form-group label { color: #e0e0e0; }
        body.dark .form-group input,
        body.dark .form-group select,
        body.dark .form-group textarea {
            background-color: #0f3460;
            border-color: #1a5276;
            color: #e0e0e0;
        }
        body.dark .btn-secondary { background-color: #0f3460; }
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-logo">
        <h1>Au<span>reus</span></h1>
        <p>Gestión de Hermandades</p>
    </div>

    <div class="sidebar-user">
        <div style="display:flex; justify-content:space-between; align-items:center;">
            <div>
                <p>{{ auth()->user()->name }}</p>
                <span>{{ auth()->user()->roles->first()?->name ?? 'usuario' }}</span>
            </div>
            <a href="{{ route('perfil.edit') }}" title="Editar perfil"
            style="color:#7f8c8d; text-decoration:none;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>
            </a>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-title">General</div>

        <a href="{{ route('dashboard') }}"
           class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            Dashboard
        </a>

        <a href="{{ route('mosaico') }}"
           class="nav-item {{ request()->routeIs('mosaico') ? 'active' : '' }}">
            Mosaico
        </a>

        @role('administrador|secretario')
        <div class="nav-section-title">Gestión</div>

        <a href="{{ route('hermanos.index') }}"
           class="nav-item {{ request()->routeIs('hermanos.*') ? 'active' : '' }}">
            Hermanos
        </a>
        @endrole

        @role('administrador')
        <a href="{{ route('usuarios.index') }}"
           class="nav-item {{ request()->routeIs('usuarios.*') ? 'active' : '' }}">
            Usuarios
        </a>
        @endrole

        @role('administrador|tesorero')
        <div class="nav-section-title">Económico</div>

        <a href="{{ route('pagos.index') }}"
           class="nav-item {{ request()->routeIs('pagos.*') ? 'active' : '' }}">
            Pagos
        </a>
        @endrole

        @role('administrador')
        <div class="nav-section-title">Sistema</div>

        <a href="{{ route('auditoria.index') }}"
           class="nav-item {{ request()->routeIs('auditoria.*') ? 'active' : '' }}">
            Auditoría
        </a>
        @endrole
    </nav>

    <div class="sidebar-bottom">
        <button class="btn-theme" onclick="toggleTheme()" id="btnTema">
            Modo oscuro
        </button>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                Cerrar sesión
            </button>
        </form>
    </div>
</aside>

<div class="main-wrapper">
    <div class="topbar">
        <h2>Au<span>reus</span> — @yield('titulo', 'Panel de control')</h2>
        <div>@yield('topbar_actions')</div>
    </div>

    <main class="main-content">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @yield('content')
    </main>
</div>

<script>
    function toggleTheme() {
        document.body.classList.toggle('dark');
        const isDark = document.body.classList.contains('dark');
        localStorage.setItem('tema', isDark ? 'dark' : 'light');
        document.getElementById('btnTema').textContent =
            isDark ? 'Modo claro' : 'Modo oscuro';
    }

    if (localStorage.getItem('tema') === 'dark') {
        document.body.classList.add('dark');
        document.getElementById('btnTema').textContent = 'Modo claro';
    }
</script>

</body>
</html>