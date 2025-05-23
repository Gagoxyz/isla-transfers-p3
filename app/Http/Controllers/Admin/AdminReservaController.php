<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransferReserva;
use Illuminate\Support\Facades\DB;


class AdminReservaController extends Controller
{

    public function index()
    {
        return view('panel.admin');
    }

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

    public function storeReturn(Request $request)
    {
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
            'fecha_modificacion' => now(),
        ];

        // Si hay datos de entrada (ida), los añadimos
        if ($request->filled(['bookingDate', 'bookingTime', 'flyNumer', 'originAirport'])) {
            $data['fecha_entrada'] = $request->bookingDate;
            $data['hora_entrada'] = $request->bookingTime;
            $data['numero_vuelo_entrada'] = $request->flyNumer;
            $data['origen_vuelo_entrada'] = $request->originAirport;
        } else {
            $data['fecha_entrada'] = null;
            $data['hora_entrada'] = null;
            $data['numero_vuelo_entrada'] = null;
            $data['origen_vuelo_entrada'] = null;
        }

        // Si hay datos de salida (vuelta), los añadimos
        if ($request->filled(['dateFly', 'timeFly', 'pickupTime'])) {
            $data['fecha_vuelo_salida'] = $request->dateFly;
            $data['hora_vuelo_salida'] = $request->timeFly;
            $data['hora_recogida_salida'] = $request->pickupTime;
        } else {
            $data['fecha_vuelo_salida'] = null;
            $data['hora_vuelo_salida'] = null;
            $data['hora_recogida_salida'] = null;
        }

        $reserva->update($data);

        return redirect()->route('admin.panel')->with('success', 'Reserva actualizada correctamente.');
    }


    public function destroy($id)
    {
        $reserva = TransferReserva::findOrFail($id);
        $reserva->delete();

        return redirect()->route('admin.panel')->with('success', 'Reserva eliminada correctamente.');
    }
    public function list()
    {
        $reservas = TransferReserva::orderBy('fecha_reserva', 'desc')->get();
        return view('panel.admin_list', compact('reservas'));
    }

    public function estadisticasPorZona()
    {
        if (!session()->has('id_admin')) {
            return response()->json(['error' => 'Acceso no autorizado.'], 403);
        }

        $total = DB::table('transfer_reservas')->count();

        $estadisticas = DB::table('transfer_reservas')
            ->join('transfer_hotel', 'transfer_reservas.id_destino', '=', 'transfer_hotel.id_hotel')
            ->join('transfer_zona', 'transfer_hotel.id_zona', '=', 'transfer_zona.id_zona')
            ->select('transfer_zona.descripcion', DB::raw('COUNT(*) as num_reservas'))
            ->groupBy('transfer_zona.descripcion')
            ->get()
            ->map(function ($zona) use ($total) {
                $zona->porcentaje = round(($zona->num_reservas / $total) * 100, 2);
                return $zona;
            });

        return response()->json($estadisticas, 200, [], JSON_PRETTY_PRINT);
    }
}
