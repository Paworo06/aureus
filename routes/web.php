<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HermanoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PlanPagoController;
use App\Http\Controllers\MosaicoController;
use App\Http\Controllers\AuditoriaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PdfController;

// Ruta raíz → login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas autenticadas
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Mosaico — accesible para todos los autenticados que sean hermanos
    Route::get('/mosaico', [MosaicoController::class, 'index'])
        ->name('mosaico');

    // Perfil para actualizar datos
    Route::get('/mi-perfil', [App\Http\Controllers\PerfilController::class, 'edit'])
        ->name('perfil.edit');
    Route::put('/mi-perfil', [App\Http\Controllers\PerfilController::class, 'update'])
        ->name('perfil.update');

    // Hermanos — solo admin y secretario
    Route::middleware(['role:administrador|secretario'])->group(function () {
        Route::resource('hermanos', HermanoController::class);
    });

    // Pagos — solo admin y tesorero
    Route::middleware(['role:administrador|tesorero'])->group(function () {
        Route::resource('pagos', PagoController::class)->except(['edit', 'update', 'destroy']);
        Route::get('/pagos/historial/{hermano}', [PagoController::class, 'historial'])
            ->name('pagos.historial');
    });

    // Plan de pago — solo admin y tesorero
    Route::middleware(['role:administrador|tesorero'])->group(function () {
        Route::resource('plan-pagos', PlanPagoController::class);
    });

    // Auditoría — solo admin
    Route::middleware(['role:administrador'])->group(function () {
        Route::get('/auditoria', [AuditoriaController::class, 'index'])
            ->name('auditoria.index');
    });

    // Gestión de usuarios — solo admin
    Route::middleware(['role:administrador'])->group(function () {
        Route::get('/usuarios', [UsuarioController::class, 'index'])
            ->name('usuarios.index');
        Route::get('/usuarios/{usuario}', [UsuarioController::class, 'show'])
            ->name('usuarios.show');
        Route::get('/usuarios/{usuario}/edit', [UsuarioController::class, 'edit'])
            ->name('usuarios.edit');
        Route::put('/usuarios/{usuario}', [UsuarioController::class, 'update'])
            ->name('usuarios.update');
        Route::post('/usuarios/{usuario}/toggle', [UsuarioController::class, 'toggleActivo'])
            ->name('usuarios.toggle');
    });

    // PDFs
    Route::middleware(['role:administrador|tesorero'])->group(function () {
        Route::get('/pdfs/recibo/{pago}', [PdfController::class, 'recibo'])
            ->name('pdfs.recibo');
    });

    Route::middleware(['role:administrador|secretario'])->group(function () {
        Route::get('/pdfs/certificado/{hermano}', [PdfController::class, 'certificado'])
            ->name('pdfs.certificado');
    });

    // Exports a Excel
    Route::middleware(['role:administrador|tesorero'])->group(function () {
        Route::get('/export-hermanos', [HermanoController::class, 'export'])
            ->name('hermanos.export');
    });
});

// Rutas de autenticación — solo login, sin registro público
Route::get('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')->name('login');

Route::post('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')->name('logout');

// Rutas de autenticación generadas por Breeze (comentadas para omitir su uso)
//require __DIR__.'/auth.php';