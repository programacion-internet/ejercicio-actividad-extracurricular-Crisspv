<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion', 'fecha'];

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'evento_user')->withTimestamps();
    }

    public function evidencias()
    {
        return $this->hasMany(Evidencia::class);
    }
}
