@extends('layouts.app')

@section('title', 'Bienvenido')

@include('modals.hotel.oneWayModal')
@include('modals.hotel.returnModal')
@include('modals.hotel.roundTripModal')

@section('content')

<div class="container py-3 mt-5">
    <h1 class="pb-5 row justify-content-center">Panel de administración CORPORATIVO</h1>
    <div class="row justify-content-center">
        <div class="col-auto">
            <button type="button" class="btn text-white fw-bold" style="background-color: #007bff;"
                data-bs-toggle="modal" data-bs-target="#hotelOneWayModal">
                <i class="fa-solid fa-circle-plus"></i> Reservar Aeropuerto-Hotel
            </button>
            <button type="button" class="btn text-white fw-bold" style="background-color: #dc3545;"
                data-bs-toggle="modal" data-bs-target="#hotelReturnModal">
                <i class="fa-solid fa-circle-plus"></i> Reservar Hotel-Aeropuerto
            </button>
            <button type="button" class="btn text-white fw-bold" style="background-color: #28a745;"
                data-bs-toggle="modal" data-bs-target="#hotelRoundTripModal">
                <i class="fa-solid fa-circle-plus"></i> Reservar ida-vuelta (Aeropuerto-Hotel/Hotel-Aeropuerto)
            </button>
        </div>
    </div>
    <hr>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
    @endif
</div>
<!-- Sección para vuelos de IDA -->
<div class="mt-5">
    <!-- Aeropuerto-Hotel Table -->
    <h4>Reservas realizadas Aeropuerto-Hotel</h4>
    <div class="table-responsive mt-3">
        <table class="table table-hover table-sm align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Localizador</th>
                    <th>Email cliente</th>
                    <th>Número vuelo</th>
                    <th>Fecha llegada</th>
                    <th>Hora llegada</th>
                    <th>Origen vuelo llegada</th>
                    <th>Pasajeros</th>
                    <th>Vehículo</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($oneWayBookings as $oneWayBooking)
                <tr>
                    <td>{{ $oneWayBooking->localizador }}</td>
                    <td>{{ $oneWayBooking->email_cliente }}</td>
                    <td>{{ $oneWayBooking->numero_vuelo_entrada }}</td>
                    <td>{{ $oneWayBooking->fecha_entrada }}</td>
                    <td>{{ $oneWayBooking->hora_entrada }}</td>
                    <td>{{ $oneWayBooking->origen_vuelo_entrada }}</td>
                    <td>{{ $oneWayBooking->num_viajeros }}</td>
                    <td>{{ $oneWayBooking->descripcionVehiculo->descripcion }}</td>
                    <td class="d-flex flex-column gap-1">
                        <button class="btn btn-warning btn-sm">
                            <i class="fa-solid fa-pen-to-square"></i> Editar
                        </button>
                        <form>
                            <button class="btn btn-danger btn-sm" type="submit">
                                <i class="fa-solid fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<!-- Aeropuerto-Hotel Table -->
<div class="mt-5">
    <h4>Reservas realizadas Hotel-Aeropuerto</h4>
    <div class="table-responsive mt-3">
        <table class="table table-hover table-sm align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Localizador</th>
                    <th>Email cliente</th>
                    <th>Fecha salida</th>
                    <th>Hora salida</th>
                    <th>Hora recogida</th>
                    <th>Pasajeros</th>
                    <th>Vehículo</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($returnBookings as $returnBooking)
                <tr>
                    <td>{{ $returnBooking->localizador }}</td>
                    <td>{{ $returnBooking->email_cliente }}</td>
                    <td>{{ $returnBooking->fecha_vuelo_salida }}</td>
                    <td>{{ $returnBooking->hora_vuelo_salida }}</td>
                    <td>{{ $returnBooking->hora_recogida_salida }}</td>
                    <td>{{ $returnBooking->num_viajeros }}</td>
                    <td>{{ $returnBooking->descripcionVehiculo->descripcion }}</td>
                    <td class="d-flex flex-column gap-1">
                        <button class="btn btn-warning btn-sm">
                            <i class="fa-solid fa-pen-to-square"></i> Editar
                        </button>
                        <form>
                            <button class="btn btn-danger btn-sm" type="submit">
                                <i class="fa-solid fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Sección para vuelos de IDA-VUELTA -->
<div class="mt-5">
    <!-- Aeropuerto-Hotel Table -->
    <h4>Reservas realizadas Ida-Vuelta (Aeropuerto-Hotel / Hotel-Aeropuerto)</h4>
    <div class="table-responsive mt-3">
        <table class="table table-hover table-sm align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Localizador</th>
                    <th>Email cliente</th>
                    <th>Número vuelo</th>
                    <th>Fecha llegada</th>
                    <th>Hora llegada</th>
                    <th>Origen vuelo llegada</th>
                    <th>Fecha salida</th>
                    <th>Hora salida</th>
                    <th>Hora recogida</th>
                    <th>Pasajeros</th>
                    <th>Vehículo</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roundTripBookings as $roundTripBooking)
                <tr>
                    <td>{{ $roundTripBooking->localizador }}</td>
                    <td>{{ $roundTripBooking->email_cliente }}</td>
                    <td>{{ $roundTripBooking->numero_vuelo_entrada }}</td>
                    <td>{{ $roundTripBooking->fecha_entrada }}</td>
                    <td>{{ $roundTripBooking->hora_entrada }}</td>
                    <td>{{ $roundTripBooking->origen_vuelo_entrada }}</td>
                    <td>{{ $roundTripBooking->fecha_vuelo_salida }}</td>
                    <td>{{ $roundTripBooking->hora_vuelo_salida }}</td>
                    <td>{{ $roundTripBooking->hora_recogida_salida }}</td>
                    <td>{{ $roundTripBooking->num_viajeros }}</td>
                    <td>{{ $roundTripBooking->descripcionVehiculo->descripcion }}</td>
                    <td class="d-flex flex-column gap-1">
                        <button class="btn btn-warning btn-sm">
                            <i class="fa-solid fa-pen-to-square"></i> Editar
                        </button>
                        <form>
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">
                                <i class="fa-solid fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection