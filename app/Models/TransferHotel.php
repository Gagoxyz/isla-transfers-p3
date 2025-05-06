<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransferHotel extends Authenticatable
{
    use HasFactory;

    // Configuración exacta de la tabla
    protected $table = 'transfer_hotel';
    protected $primaryKey = 'id_hotel';
    public $timestamps = false; // Sin timestamps (no hay created_at/updated_at)

    // Columnas fillable (asignables masivamente)
    protected $fillable = [
        'nombre_hotel',
        'email_hotel',
        'password',
        // faltan datos
    ];

    // Columnas ocultas en respuestas JSON
    protected $hidden = [
        'password',
    ];

    // Método para estandarizar el campo email (opcional pero útil)
    // public function getEmailAttribute()
    // {
    //     return $this->email_admin; // Permite usar Auth::user()->email
    // }

    public function transferReserva() {
        return $this->hasMany(TransferReserva::class);
    }
}
