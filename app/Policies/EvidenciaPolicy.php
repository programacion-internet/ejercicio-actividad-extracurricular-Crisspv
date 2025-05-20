<?php

namespace App\Policies;

use App\Models\Evidencia;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Evento;

class EvidenciaPolicy
{
    public function delete(User $user, Evidencia $evidencia): bool
    {
        return $user->id === $evidencia->user_id;
    }

    public function upload(User $user, Evento $evento): bool
    {
        return $evento->alumnos->contains($user);
    }
}