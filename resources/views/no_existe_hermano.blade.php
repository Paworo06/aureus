@extends('layouts.app')

@section('titulo', 'Sin acceso')

@section('content')
<div class="card" style="text-align:center; padding: 3rem;">
    <div style="font-size: 3rem; margin-bottom: 1rem;">⚠️</div>
    <h2 style="color: var(--azul); margin-bottom: 0.75rem;">
        Tu usuario no está vinculado a ningún hermano
    </h2>
    <p style="color: var(--gris); margin-bottom: 1.5rem;">
        Para acceder a la aplicación necesitas estar registrado como hermano.<br>
        Contacta con el administrador para que vincule tu DNI.
    </p>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-naranja">Cerrar sesión</button>
    </form>
</div>
@endsection