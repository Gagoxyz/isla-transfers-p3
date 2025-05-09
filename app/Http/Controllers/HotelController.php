<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransferHotel;
use App\Models\TransferZona;
use Illuminate\Support\Facades\Session;

class HotelController extends Controller
{
    public function index()
    {
        if (!Session::has('id_admin')) {
            return redirect()->route('login')->withErrors('Acceso no autorizado');
        }

        $hoteles = TransferHotel::with('zona')->get();
        $zonas = TransferZona::all();
        

        return view('panel.hotel', compact('hoteles', 'zonas'));
    }

    public function store(Request $request)
    {
        if (!Session::has('id_admin')) return redirect()->route('login');

        TransferHotel::create([
            'nombre_hotel' => $request->hotelName,
            'id_zona' => $request->zoneSelect,
            'comision' => $request->hotelCommission,
            'email_hotel' => $request->hotelEmail,
            'password' => $request->hotelPassword,
        ]);

        return redirect()->route('admin.hoteles.index')->with('success', 'Hotel registrado correctamente');
    }

    public function update(Request $request)
    {
        if (!Session::has('id_admin')) return redirect()->route('login');

        $hotel = TransferHotel::findOrFail($request->id_hotel);
        $hotel->update([
            'nombre_hotel' => $request->hotelName,
            'id_zona' => $request->zoneSelect,
            'comision' => $request->hotelCommission,
            'email_hotel' => $request->hotelEmail,
            'password' => $request->hotelPassword,
        ]);

        return redirect()->route('admin.hoteles.index')->with('success', 'Hotel registrado correctamente');
    }

    public function destroy($id){
    if (!Session::has('id_admin')) return redirect()->route('login');

    $hotel = TransferHotel::findOrFail($id);
    $hotel->delete();

    return redirect()->route('admin.hoteles.index')->with('success', 'Hotel eliminado correctamente');
}

}
