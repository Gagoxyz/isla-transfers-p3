<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransferReserva;
use Illuminate\Support\Facades\Session;

class AdminReservaController extends Controller
{
    //Añadir desde el panel admin una reserva de solo ida
    public function storeOneWay(Request $request)
    {
        if (!Session::has('id_admin')) {
            return redirect()->route('login')->withErrors('Acceso no autorizado');
        }
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

    public function storeReturn(Request $request)
    {
        if (!Session::has('id_admin')) {
            return redirect()->route('login')->withErrors('Acceso no autorizado');
        }
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
        if (!Session::has('id_admin')) {
            return redirect()->route('login')->withErrors('Acceso no autorizado');
        }
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
        if (!Session::has('id_admin')) {
            return redirect()->route('login')->withErrors('Acceso no autorizado');
        }
        $reserva = \App\Models\TransferReserva::findOrFail($id);
        return response()->json($reserva);
    }

    public function update(Request $request, $id)
    {
        if (!Session::has('id_admin')) {
            return redirect()->route('login')->withErrors('Acceso no autorizado');
        }
        $reserva = \App\Models\TransferReserva::findOrFail($id);
        $tipo = $request->input('tipoReserva');

        $request->validate([
            'uuid' => 'required|string|max:255',
            'customerEmailSelect' => 'required|email',
            'hotelSelect' => 'nullable|integer',
            'carSelect' => 'nullable|integer',
            'passengerNum' => 'nullable|integer|min:1',
        ]);

        $data = [
            'localizador' => $request->uuid,
            'email_cliente' => $request->customerEmailSelect,
            'id_destino' => $request->hotelSelect,
            'id_vehiculo' => $request->carSelect,
            'num_viajeros' => $request->passengerNum,
        ];

        if (($tipo == 1 || $tipo == 3) && $request->filled('bookingDate')) {
            $data['fecha_entrada'] = $request->bookingDate;
            $data['hora_entrada'] = $request->bookingTime;
            $data['numero_vuelo_entrada'] = $request->flyNumer;
            $data['origen_vuelo_entrada'] = $request->originAirport;
        }


        if ($tipo == 2 || $tipo == 3) {
            $data['fecha_vuelo_salida'] = $request->dateFly;
            $data['hora_vuelo_salida'] = $request->timeFly;
            $data['hora_recogida_salida'] = $request->pickupTime;
        }
        $data['fecha_modificacion'] = now();
        $reserva->update($data);


        $reserva->update($data);

        return redirect()->route('admin.panel')->with('success', 'Reserva actualizada correctamente.');
    }


    public function destroy($id)
    {
        if (!Session::has('id_admin')) {
            return redirect()->route('login')->withErrors('Acceso no autorizado');
        }
        $reserva = TransferReserva::findOrFail($id);
        $reserva->delete();

        return redirect()->route('admin.panel')->with('success', 'Reserva eliminada correctamente.');
    }
    public function list()
    {
        if (!Session::has('id_admin')) {
            return redirect()->route('login')->withErrors('Acceso no autorizado');
        }
        $reservas = TransferReserva::orderBy('fecha_reserva', 'desc')->get();
        return view('panel.admin_list', compact('reservas'));
    }
}
