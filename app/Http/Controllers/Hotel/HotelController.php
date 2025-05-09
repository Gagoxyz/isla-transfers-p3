<?php

namespace App\Http\Controllers\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        if (!Session::has('id_hotel')) {
            return redirect()->route('login')->withErrors('Acceso no autorizado');
        }

        $hoteles = TransferHotel::with('zona')->get();
        $zonas = TransferZona::all();


        return view('panel.admin.hotel.adminHotel', compact('hoteles', 'zonas'));
    }
}
