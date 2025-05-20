<?php

namespace App\Providers;

use App\Models\Evidencia;
use App\Policies\EvidenciaPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Evento;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Evidencia::class => EvidenciaPolicy::class,

    ];

    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('inscribirse-evento', function ($user, Evento $evento) {
            return $user->role === 'alumno'
                && !$evento->alumnos->contains($user);
        });
    }
    
}

