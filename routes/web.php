<?php

use App\Http\Controllers\EstadisticasController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;

//INVENTARIO
Route::get('/', [InventarioController::class, 'index'])->name('inventario.index');
Route::get('/mp/create', [InventarioController::class, 'create'])->name('inventario.create');
Route::post('/mp/store', [InventarioController::class, 'store'])->name('inventario.store');

//PRODUCTOS
Route::get('/productos/create', [ProductoController::class, 'create'])->name('producto.create');
Route::post('/productos/store', [ProductoController::class, 'store'])->name('producto.store');

//VENTAS
Route::get('/venta/create', [VentaController::class, 'create'])->name('venta.create');
Route::post('/venta/store', [VentaController::class, 'store'])->name('venta.store');

//ESTADISTICAS
Route::get('/estadisticas/index', [EstadisticasController::class, 'index'])->name('estadisticas.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
