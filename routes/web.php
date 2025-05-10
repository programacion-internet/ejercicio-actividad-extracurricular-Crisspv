<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\ArchivoEventoController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

// Rutas de eventos
    Route::resource('eventos', EventoController::class);
// Ruta personalizada para inscribirse a un evento (POST)
    Route::post('/eventos/{evento}/inscribirse', [EventoController::class, 'inscribirse'])->name('eventos.inscribirse');
});

    Route::post('/eventos/{evento}/archivos', [ArchivoEventoController::class, 'store'])->name('archivos.store');
    Route::delete('/archivos/{archivoEvento}', [ArchivoEventoController::class, 'destroy'])->name('archivos.destroy');
require __DIR__.'/auth.php';
