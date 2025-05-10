<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\ArchivoEvento;
use App\Policies\ArchivoEventoPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('subir-archivo', function ($user, $evento) {
            return $user->role === 'alumno' && $evento->alumnos->contains($user->id);
        });
    
        Gate::define('eliminar-archivo', function ($user, $archivo) {
            return $archivo->user_id === $user->id;
        });
    }
    
    protected $policies = [
        ArchivoEvento::class => ArchivoEventoPolicy::class,
    ];
}
