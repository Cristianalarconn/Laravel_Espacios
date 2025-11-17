<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $fillable = [
        'user_id',
        'espacio_id',
        'fecha_inicio',
        'fecha_fin',
        'motivo',
        'estado'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function espacio()
    {
        return $this->belongsTo(Espacio::class);
    }
}
