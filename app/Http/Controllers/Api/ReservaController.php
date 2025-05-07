<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TransferReserva;

class ReservaController extends Controller
{
    public function index()
    {
        $reservas = TransferReserva::with(['vehiculo', 'destinoHotel'])->get();

        $formateadas = [];

        foreach ($reservas as $reserva) {
            $baseTitle = "{$reserva->localizador} - {$reserva->destinoHotel->nombre_hotel} - {$reserva->email_cliente}";
            $commonInfo = "Localizador: {$reserva->localizador}\nCliente: {$reserva->email_cliente}\nHotel: {$reserva->destinoHotel->nombre_hotel}\nPasajeros: {$reserva->num_viajeros}";

            if ($reserva->fecha_entrada) {
                $formateadas[] = [
                    'id' => $reserva->id_reserva . '-ida',
                    'title' => $baseTitle . ' (IDA)',
                    'start' => $reserva->fecha_entrada . 'T' . ($reserva->hora_entrada ?? '00:00:00'),
                    'color' => $reserva->fecha_vuelo_salida ? '#28a745' : '#007bff',
                ];
            }

            if ($reserva->fecha_vuelo_salida) {
                $formateadas[] = [
                    'id' => $reserva->id_reserva . '-vuelta',
                    'title' => $baseTitle . ' (VUELTA)',
                    'start' => $reserva->fecha_vuelo_salida . 'T' . ($reserva->hora_vuelo_salida ?? '00:00:00'),
                    'color' => $reserva->fecha_entrada ? '#28a745' : '#dc3545',
                ];
            }
        }

        return response()->json($formateadas);
    }
}
