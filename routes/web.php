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
    // Dashboard - Mostrar productos según el rol del usuario
    Route::get('/dashboard', function () {
        $query = \App\Models\Producto::query();

        // Si el usuario no es admin, solo mostrar sus propios productos
        if (!auth()->user()->isAdmin()) {
            $query->where('user_id', auth()->id());
        }
        // Si es admin, ve todos los productos (incluso los que no tienen user_id)

        $productos = $query->paginate(10);
        return view('dashboard', compact('productos'));
    })->name('dashboard');

    // Redireccionar /productos a /dashboard
    Route::get('/productos', function () {
        return redirect()->route('dashboard');
    });

    // Rutas del controlador de productos (CRUD completo) - sin index
    Route::resource('productos', ProductoController::class)->except(['index']);
});
