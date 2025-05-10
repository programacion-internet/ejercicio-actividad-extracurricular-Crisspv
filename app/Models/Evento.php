<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\ArchivoEvento;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'evento_user');
    }

    public function archivosEvento()
    {
        return $this->hasMany(ArchivoEvento::class);
    }
    
}
