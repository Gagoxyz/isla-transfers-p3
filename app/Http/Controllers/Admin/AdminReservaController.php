<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransferReserva;

class AdminReservaController extends Controller
{
    public function storeOneWay(Request $request)
    {
        $request->validate([
            'uuid' => 'required|string|max:255',
            'bookingDate' => 'required|date',
            'bookingTime' => 'required',
            'flyNumer' => 'required|string|max:255',
            'originAirport' => 'required|string|max:255',
            'hotelSelect' => 'required|integer',
            'carSelect' => 'required|integer',
            'passengerNum' => 'required|integer|min:1',
            'customerEmailSelect' => 'required|email',
        ]);

        TransferReserva::create([
            'localizador' => $request->uuid,
            'fecha_entrada' => $request->bookingDate,
            'hora_entrada' => $request->bookingTime,
            'numero_vuelo_entrada' => $request->flyNumer,
            'origen_vuelo_entrada' => $request->originAirport,
            'id_destino' => $request->hotelSelect,
            'id_vehiculo' => $request->carSelect,
            'num_viajeros' => $request->passengerNum,
            'email_cliente' => $request->customerEmailSelect,
            'id_tipo_reserva' => 3 // Tipo admin
        ]);

        return redirect()->route('admin.panel')->with('success', 'Reserva creada correctamente');
    }
}
