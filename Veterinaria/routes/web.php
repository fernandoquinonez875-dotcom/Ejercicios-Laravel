<?php

// Cascaron Veterinaria, etapa 5

use App\Http\Controllers\MascotaController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store'])
    ->middleware('throttle:6,1')->name('login.store');

Route::middleware('auth')->group(function () {
    Route::get('/inicio', function () {
        return redirect()->route('mascotas.index');
    })->name('inicio');

    Route::get('/mascotas', [MascotaController::class, 'index'])
        ->name('mascotas.index');

    Route::get('/mascotas/crear', [MascotaController::class, 'create'])
        ->name('mascotas.create');
    Route::post('/mascotas', [MascotaController::class, 'store'])
        ->name('mascotas.store');

    Route::get('/mascotas/{id}/editar', [MascotaController::class, 'edit'])
        ->whereNumber('id')->name('mascotas.edit');
    Route::put('/mascotas/{id}', [MascotaController::class, 'update'])
        ->whereNumber('id')->name('mascotas.update');

    Route::delete('/mascotas/{id}', [MascotaController::class, 'destroy'])
        ->whereNumber('id')->name('mascotas.destroy');

    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
});
