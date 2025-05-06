<?php
// app/Models/TransferReserva.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferReserva extends Model
{
    use HasFactory;

    // Definir la tabla asociada al modelo
    protected $table = 'transfer_reservas';

    // Definir la clave primaria
    protected $primaryKey = 'id_reserva';

    // Si la tabla no tiene los timestamps (created_at y updated_at), desactívalos
    public $timestamps = false;

    // Definir los campos que son asignables en masa (por protección de datos)
    protected $fillable = [
        'localizador',
        'id_hotel',
        'id_tipo_reserva',
        'email_cliente',
        'fecha_reserva',
        'fecha_modificacion',
        'id_destino',
        'fecha_entrada',
        'hora_entrada',
        'numero_vuelo_entrada',
        'origen_vuelo_entrada',
        'hora_vuelo_salida',
        'fecha_vuelo_salida',
        'hora_recogida_salida',
        'num_viajeros',
        'id_vehiculo',
    ];

    // Definir las relaciones de Eloquent

    public function destinoHotel()
    {
        return $this->belongsTo(TransferHotel::class, 'id_destino', 'id_hotel');
    }

    public function tipoReserva()
    {
        return $this->belongsTo(TipoReserva::class, 'id_tipo_reserva', 'id_tipo_reserva');
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'id_vehiculo', 'id_vehiculo');
    }

    public function destino()
    {
        return $this->belongsTo(Hotel::class, 'id_destino', 'id_hotel'); // Aquí se asume que `id_destino` también hace referencia a un hotel
    }
}
