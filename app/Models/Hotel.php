<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $table = 'transfer_hotel'; // Nombre real de la tabla
    protected $primaryKey = 'id_hotel'; // Clave primaria

    public $timestamps = false; // Si no tienes columnas created_at y updated_at

    protected $fillable = [
        'nombre_hotel',
        'id_zona',
        'comision',
        'email_hotel',
        'password'
    ];
}
