<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransferReserva;
use App\Models\TransferHotel;
use Carbon\Carbon;

class AdminComisionController extends Controller
{
    public function verComisionesHoteles()
    {
        $mes = now()->month;
        $año = now()->year;

        // $hoteles = TransferHotel::with(['reservas' => function ($query) use ($mes, $año) {
        //     $query->whereMonth('fecha_reserva', $mes)
        //           ->whereYear('fecha_reserva', $año);
        // }])->get();

        $hoteles = TransferHotel::with(['zona', 'reservas.vehiculo'])
            ->get()
            ->map(function ($hotel) {
                $reservas = $hotel->reservas->map(function ($reserva) {
                    return [
                        'localizador' => $reserva->localizador,
                        'email_cliente' => $reserva->email_cliente,
                        'fecha_reserva' => $reserva->fecha_reserva,
                        'vehiculo' => $reserva->vehiculo->descripcion ?? '',
                        'precio' => number_format($reserva->precio, 2),
                        'comision' => number_format($reserva->comision_hotel, 2),
                    ];
                });

                $hotel->reservas_resumen = $reservas;
                $hotel->comision_total = $hotel->reservas->sum('comision_hotel');

                return $hotel;
            });

        $hoteles->each(function ($hotel) {
            $hotel->comision_total = $hotel->reservas->sum(function ($reserva) use ($hotel) {
                return round(($reserva->precio * $hotel->comision) / 100, 2);
            });
        });

        return view('panel.admin.commission', [
            'hoteles' => $hoteles,
            'mes' => Carbon::now()->format('F Y')
        ]);
    }
}
