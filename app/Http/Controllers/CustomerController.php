<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransferReserva;

class CustomerController extends Controller
{
    public function panel()
    {
        return view('panel.customer');
    }

    public function index()
    {
        // Obtener todas las reservas
        //$reservas = TransferReserva::all();  // También puedes usar otros métodos como where(), orderBy(), etc.
        $reservas = TransferReserva::with('destinoHotel')->get();
        return view('panel.customer', compact('reservas'));
    }
}
