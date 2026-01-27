<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\ProductoController;

// Ruta principal - Redirecciona a dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Rutas protegidas por autenticación
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Dashboard - Mostrar productos
    Route::get('/dashboard', function () {
        $productos = \App\Models\Producto::paginate(10);
        return view('dashboard', compact('productos'));
    })->name('dashboard');

    // Redireccionar /productos a /dashboard
    Route::get('/productos', function () {
        return redirect()->route('dashboard');
    });

    // Rutas del controlador de productos (CRUD completo) - sin index
    Route::resource('productos', ProductoController::class)->except(['index']);
});
