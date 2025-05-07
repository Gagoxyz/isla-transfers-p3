@extends('layouts.app')

@section('title', 'Bienvenido')

@section('content')

@include('modals.customer.oneWayModal')
@include('modals.customer.editOneWayModal')
@include('modals.customer.returnModal')
@include('modals.customer.roundTripModal')

<div class="container py-5">
    @if (session('success'))
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
    <div class="glass-card">
        <h1 class="text-center mb-5">Panel de administración de clientes</h1>

        <div class="d-flex flex-wrap justify-content-center gap-3 mb-5">
            <button type="button" class="btn btn-primary glass-btn"
                data-bs-toggle="modal" data-bs-target="#oneWayModal">
                <i class="fa-solid fa-circle-plus"></i> Reservar Aeropuerto-Hotel
            </button>

            <button type="button" class="btn btn-danger glass-btn"
                data-bs-toggle="modal" data-bs-target="#returnModal">
                <i class="fa-solid fa-circle-plus"></i> Reservar Hotel-Aeropuerto
            </button>

            <button type="button" class="btn btn-success glass-btn"
                data-bs-toggle="modal" data-bs-target="#roundTripModal">
                <i class="fa-solid fa-circle-plus"></i> Reservar ida-vuelta
            </button>
        </div>

        <!-- Sección para vuelos de IDA -->
        <div class="mt-5">
            <!-- Aeropuerto-Hotel Table -->
            <h4 class="text-white">Reservas realizadas Aeropuerto-Hotel</h4>
            <div class="table-responsive mt-3">
                <table class="table table-hover table-sm align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Realizada por</th>
                            <th>Localizador</th>
                            <th>Email cliente</th>
                            <th>Fecha reserva</th>
                            <th>Destino</th>
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
                            <td>{{ $oneWayBooking->realizadaPor->descripcion }}</td>
                            <td>{{ $oneWayBooking->localizador }}</td>
                            <td>{{ $oneWayBooking->email_cliente }}</td>
                            <td>{{ $oneWayBooking->fecha_reserva }}</td>
                            <td>{{ $oneWayBooking->destinoHotel->nombre_hotel }}</td>
                            <td>{{ $oneWayBooking->numero_vuelo_entrada }}</td>
                            <td>{{ $oneWayBooking->fecha_entrada }}</td>
                            <td>{{ $oneWayBooking->hora_entrada }}</td>
                            <td>{{ $oneWayBooking->origen_vuelo_entrada }}</td>
                            <td>{{ $oneWayBooking->num_viajeros }}</td>
                            <td>{{ $oneWayBooking->descripcionVehiculo->descripcion }}</td>
                            <td class="d-flex flex-column gap-1">
                                <button class="btn btn-warning btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editOneWayModal"
                                    onclick='fillEditModal(@json($oneWayBooking))'>
                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                </button>
                                <form action="{{ route('booking.destroyOneWay', $oneWayBooking->id_reserva) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta reserva?');">
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

        <!-- Sección para vuelos de VUELTA -->
        <div class="mt-5">
            <!-- Aeropuerto-Hotel Table -->
            <h4 class="text-white">Reservas realizadas Hotel-Aeropuerto</h4>
            <div class="table-responsive mt-3">
                <table class="table table-hover table-sm align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Realizada por</th>
                            <th>Localizador</th>
                            <th>Email cliente</th>
                            <th>Fecha reserva</th>
                            <th>Destino</th>
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
                            <td>{{ $returnBooking->realizadaPor->descripcion }}</td>
                            <td>{{ $returnBooking->localizador }}</td>
                            <td>{{ $returnBooking->email_cliente }}</td>
                            <td>{{ $returnBooking->fecha_reserva }}</td>
                            <td>{{ $returnBooking->destinoHotel->nombre_hotel }}</td>
                            <td>{{ $returnBooking->fecha_vuelo_salida }}</td>
                            <td>{{ $returnBooking->hora_vuelo_salida }}</td>
                            <td>{{ $returnBooking->hora_recogida_salida }}</td>
                            <td>{{ $returnBooking->num_viajeros }}</td>
                            <td>{{ $returnBooking->descripcionVehiculo->descripcion }}</td>
                            <td class="d-flex flex-column gap-1">
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editOneWayModal">
                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                </button>
                                <button class="btn btn-danger btn-sm" type="submit">
                                    <i class="fa-solid fa-trash"></i> Eliminar
                                </button>
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
            <h4 class="text-white">Reservas realizadas Ida-Vuelta (Aeropuerto-Hotel / Hotel-Aeropuerto)</h4>
            <div class="table-responsive mt-3">
                <table class="table table-hover table-sm align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Realizada por</th>
                            <th>Localizador</th>
                            <th>Email cliente</th>
                            <th>Fecha reserva</th>
                            <th>Destino</th>
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
                            <td>{{ $roundTripBooking->realizadaPor->descripcion }}</td>
                            <td>{{ $roundTripBooking->localizador }}</td>
                            <td>{{ $roundTripBooking->email_cliente }}</td>
                            <td>{{ $roundTripBooking->fecha_reserva }}</td>
                            <td>{{ $roundTripBooking->destinoHotel->nombre_hotel }}</td>
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
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editOneWayModal">
                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                </button>
                                <button class="btn btn-danger btn-sm" type="submit">
                                    <i class="fa-solid fa-trash"></i> Eliminar
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function fillEditModal(booking) {
        console.log(booking); // Verifica en consola que booking.id existe
        document.getElementById('edit_id').value = booking.id_reserva;
        document.getElementById('edit_fecha_entrada').value = booking.fecha_entrada;
        document.getElementById('edit_hora_entrada').value = booking.hora_entrada;
        document.getElementById('edit_numero_vuelo_entrada').value = booking.numero_vuelo_entrada;
        document.getElementById('edit_origen_vuelo_entrada').value = booking.origen_vuelo_entrada;
        document.getElementById('edit_num_viajeros').value = booking.num_viajeros;
        document.getElementById('edit_id_vehiculo').value = booking.id_vehiculo;
        document.getElementById('edit_id_hotel').value = booking.id_destino;
        document.getElementById('edit_uuid').value = booking.localizador;
    }
</script>

@endsection