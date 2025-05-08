<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransferReserva;

class AdminReservaController extends Controller
{
    //Añadir desde el panel admin una reserva de solo ida
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

    public function storeReturn(Request $request){
    $request->validate([
        'uuid' => 'required|string|max:255',
        'dateFly' => 'required|date',
        'timeFly' => 'required',
        'pickupTime' => 'required',
        'hotelSelect' => 'required|integer',
        'carSelect' => 'required|integer',
        'passengerNum' => 'required|integer|min:1',
        'customerEmailSelect' => 'required|email',
    ]);

    \App\Models\TransferReserva::create([
        'localizador' => $request->uuid,
        'fecha_vuelo_salida' => $request->dateFly,
        'hora_vuelo_salida' => $request->timeFly,
        'hora_recogida_salida' => $request->pickupTime,
        'id_destino' => $request->hotelSelect,
        'id_vehiculo' => $request->carSelect,
        'num_viajeros' => $request->passengerNum,
        'email_cliente' => $request->customerEmailSelect,
        'id_tipo_reserva' => 3 // Tipo administrador
    ]);

    return redirect()->route('admin.panel')->with('success', 'Reserva de vuelta creada correctamente.');
}

public function storeRoundTrip(Request $request)
{
    $request->validate([
        'uuid' => 'required|string|max:255',
        'bookingDate' => 'required|date',
        'bookingTime' => 'required',
        'flyNumer' => 'required|string|max:255',
        'originAirport' => 'required|string|max:255',
        'dateFly' => 'required|date',
        'timeFly' => 'required',
        'pickupTime' => 'required',
        'hotelSelect' => 'required|integer',
        'carSelect' => 'required|integer',
        'passengerNum' => 'required|integer|min:1',
        'customerEmailSelect' => 'required|email',
    ]);

    \App\Models\TransferReserva::create([
        'localizador' => $request->uuid,
        'fecha_entrada' => $request->bookingDate,
        'hora_entrada' => $request->bookingTime,
        'numero_vuelo_entrada' => $request->flyNumer,
        'origen_vuelo_entrada' => $request->originAirport,
        'fecha_vuelo_salida' => $request->dateFly,
        'hora_vuelo_salida' => $request->timeFly,
        'hora_recogida_salida' => $request->pickupTime,
        'id_destino' => $request->hotelSelect,
        'id_vehiculo' => $request->carSelect,
        'num_viajeros' => $request->passengerNum,
        'email_cliente' => $request->customerEmailSelect,
        'id_tipo_reserva' => 3 // Tipo administrador
    ]);

    return redirect()->route('admin.panel')->with('success', 'Reserva de ida y vuelta creada correctamente.');
}

public function show($id)
{
    $reserva = \App\Models\TransferReserva::findOrFail($id);
    return response()->json($reserva);
}

public function update(Request $request, $id)
{
    $reserva = \App\Models\TransferReserva::findOrFail($id);

    $reserva->update($request->all()); // puedes usar $request->validate([...]) si prefieres

    return redirect()->route('admin.panel')->with('success', 'Reserva actualizada correctamente.');
}


}
