<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VideojuegoController;
use App\Models\Videojuego;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/videojuegos/tengo/{videojuego}', [VideojuegoController::class, 'tengo'])->name('videojuegos.tengo');
Route::get('/videojuegos/notengo/{videojuego}', [VideojuegoController::class, 'notengo'])->name('videojuegos.notengo');
Route::get('/videojuegos/poseo', [VideojuegoController::class, 'poseo'])->name('videojuegos.poseo');

Route::resource('videojuegos', VideojuegoController::class);
