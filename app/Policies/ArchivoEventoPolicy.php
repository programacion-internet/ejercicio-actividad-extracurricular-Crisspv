<?php

namespace App\Policies;

use App\Models\ArchivoEvento;
use App\Models\User;

class ArchivoEventoPolicy
{
    /**
     * Determina si el usuario puede eliminar un archivo.
     */
    public function delete(User $user, ArchivoEvento $archivoEvento): bool
    {
        return $user->id === $archivoEvento->user_id;
    }

    /**
     * Verifica si el usuario puede subir archivos al evento.
     */
    public function upload(User $user, ArchivoEvento $archivoEvento): bool
    {
        return $user->eventos->contains($archivoEvento->evento_id);
    }
}
