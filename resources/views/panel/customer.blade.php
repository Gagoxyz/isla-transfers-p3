@extends('layouts.app')

@section('title', 'Bienvenido')

@section('content')
<div class="container py-3 mt-5">
    <h1 class="pb-5 row justify-content-center">Panel de administración de clientes</h1>
    <div class="row justify-content-center">
        <div class="col-auto">

            <button type="button" class="btn text-white fw-bold" style="background-color: #007bff;"
                onmouseover="this.style.backgroundColor='#0056b3'"
                onmouseout="this.style.backgroundColor='#007bff'"
                data-bs-toggle="modal" data-bs-target="#oneWayModal">
                <i class="fa-solid fa-circle-plus"></i> Reservar Aeropuerto-Hotel
            </button>

            <button type="button" class="btn text-white fw-bold" style="background-color: #dc3545;"
                onmouseover="this.style.backgroundColor='#a71d2a'"
                onmouseout="this.style.backgroundColor='#dc3545'"
                data-bs-toggle="modal" data-bs-target="#returnModal">
                <i class="fa-solid fa-circle-plus"></i> Reservar Hotel-Aeropuerto
            </button>

            <button type="button" class="btn text-white fw-bold" style="background-color: #28a745;"
                onmouseover="this.style.backgroundColor='#1e7e34'"
                onmouseout="this.style.backgroundColor='#28a745'"
                data-bs-toggle="modal" data-bs-target="#roundTripModal">
                <i class="fa-solid fa-circle-plus"></i> Reservar ida-vuelta (Aeropuerto-Hotel/Hotel-Aeropuerto)
            </button>
        </div>
    </div>

    <div class="container py-5">
        <h5>Reservas realizadas Aeropuerto-Hotel</h5>
        <!-- @php
        print_r($reservas);
        @endphp -->
        <table class="table table-sm table-striped table-hover mt-4 table-custom">
            <thead class="table-dark">
                <tr>
                    <th>Realizada por</th>
                    <th>Localizador</th>
                    <th>Email cliente</th>
                    <th>Fecha reserva</th>
                    <th>Destino</th>
                    <th>Número de vuelo</th>
                    <th>Fecha de llegada</th>
                    <th>Hora de llegada</th>
                    <th>Origen del vuelo llegada</th>
                    <th>Pasajeros</th>
                    <th>Vehículo</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @forEach ($reservas as $campo)
                <tr>
                    <td>{{ $campo->id_tipo_reserva }}</td>
                    <td>{{ $campo->localizador }}</td>
                    <td>{{ $campo->email_cliente }}</td>
                    <td>{{ $campo->fecha_reserva }}</td>
                    <td>{{ $campo->destinoHotel->nombre_hotel }}</td>
                    <td>{{ $campo->numero_vuelo_entrada }}</td>
                    <td>{{ $campo->fecha_entrada }}</td>
                    <td>{{ $campo->hora_entrada }}</td>
                    <td>{{ $campo->origen_vuelo_entrada }}</td>
                    <td>{{ $campo->num_viajeros }}</td>
                    <td>{{ $campo->id_vehiculo }}</td>
                    <td>Acción</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

<!-- fin del div principal -->
</div>

@endsection