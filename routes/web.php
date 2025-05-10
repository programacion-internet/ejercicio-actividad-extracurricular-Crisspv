<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\EvidenciaController;

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

Route::get('/eventos', [EventoController::class, 'index'])->name('eventos.index');
Route::get('/eventos/{evento}', [EventoController::class, 'show'])->name('eventos.show');

Route::middleware(['auth'])->group(function () {
    Route::post('/eventos/{evento}/inscribirse', [EventoController::class, 'inscribirse
::contentReference[oaicite:0]{index=0}'])->name('eventos.inscribirse');
    Route::post('/eventos/{evento}/evidencias', [EvidenciaController::class, 'store'])->name('eventos.evidencias.store');
    Route::delete('/evidencias/{evidencia}', [EvidenciaController::class, 'destroy'])->name('evidencias.destroy');
});
Route::get('/eventos/{evento}/evidencias', [EvidenciaController::class, 'index'])->name('eventos.evidencias.index');
Route::get('/eventos/{evento}/evidencias/{evidencia}', [EvidenciaController::class, 'show'])->name('eventos.evidencias.show');

Route::post('/eventos/{evento}/evidencias', [EvidenciaController::class, 'store'])->name('evidencias.store');
Route::delete('/evidencias/{evidencia}', [EvidenciaController::class, 'destroy'])->name('evidencias.destroy');
Route::get('/eventos/{evento}/evidencias', [EvidenciaController::class, 'index'])->name('eventos.evidencias.index');

Route::post('/eventos/{evento}/inscribirse', [EventoController::class, 'inscribirse'])->name('eventos.inscribirse');


require __DIR__.'/auth.php';
