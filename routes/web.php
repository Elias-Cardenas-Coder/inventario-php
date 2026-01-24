<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\ProductoController;

// Ruta principal - Redirecciona a productos
Route::get('/', function () {
    return redirect()->route('productos.index');
});

// Rutas del controlador de productos (CRUD completo)
Route::resource('productos', ProductoController::class);
