<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = 'transfer_vehiculo'; // nombre real de la tabla
    protected $primaryKey = 'id_vehiculo';
    public $timestamps = false;

    protected $fillable = [
        'descripcion',
        'email_conductor',
        'password',
    ];
}
