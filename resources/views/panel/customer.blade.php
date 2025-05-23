@extends('layouts.app')

@section('title', 'Cliente - Reservas')

@section('content')

@include('modals.customer.oneWayModal')
@include('modals.customer.editOneWayModal')
@include('modals.customer.returnModal')
@include('modals.customer.editReturnModal')
@include('modals.customer.roundTripModal')
@include('modals.customer.editRoundTripModal')

<div class="container py-5">
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
        <i class="fa-solid fa-triangle-exclamation me-2"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
    @endif
    <div class="glass-card p-4 rounded shadow">
        <h2 class="text-center fw-bold mb-4 text-success">
            <i class="fa-solid fa-user me-2"></i> Panel de administración de clientes
        </h2>

        <div class="d-flex flex-wrap justify-content-center gap-3 mb-4">
            <button type="button" class="btn btn-outline-primary fw-bold shadow-sm d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#oneWayModal">
                <i class="fa-solid fa-circle-plus me-2"></i> Aeropuerto-Hotel
            </button>

            <button type="button" class="btn btn-outline-danger fw-bold shadow-sm d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#returnModal">
                <i class="fa-solid fa-circle-plus me-2"></i> Hotel-Aeropuerto
            </button>

            <button type="button" class="btn btn-outline-success fw-bold shadow-sm d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#roundTripModal">
                <i class="fa-solid fa-circle-plus me-2"></i> Ida y vuelta
            </button>
        </div>
        <hr class="text-success">

        <!-- TABLAS -->
        <div class="mt-5">
            <h5 class="text-primary mb-3">
                <i class="fa-solid fa-plane-arrival me-2"></i> Reservas realizadas Aeropuerto-Hotel
            </h5>
            <div class="table-responsive">
                <table class="table table-hover table-sm align-middle rounded shadow-sm">
                    <thead class="table-primary text-dark">
                        <tr>
                            <th>Realizada por</th>
                            <th>Localizador</th>
                            <th>Email cliente</th>
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
                            <td>{{ $oneWayBooking->destinoHotel->nombre_hotel }}</td>
                            <td>{{ $oneWayBooking->numero_vuelo_entrada }}</td>
                            <td>{{ $oneWayBooking->fecha_entrada }}</td>
                            <td>{{ $oneWayBooking->hora_entrada }}</td>
                            <td>{{ $oneWayBooking->origen_vuelo_entrada }}</td>
                            <td>{{ $oneWayBooking->num_viajeros }}</td>
                            <td>{{ $oneWayBooking->descripcionVehiculo->descripcion }}</td>
                            <td class="d-flex gap-2">
                                <button class="btn btn-outline-success btn-sm px-2 py-1 action-icon-btn" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editOneWayModal"
                                    onclick='fillEditOneWayModal(@json($oneWayBooking))'>
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <form action="{{ route('booking.destroyOneWay', $oneWayBooking->id_reserva) }}" method="POST" 
                                    onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta reserva?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm px-2 py-1 action-icon-btn" type="submit">
                                        <i class="fa-solid fa-trash"></i>
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
            <h5 class="text-danger mb-3">
                <i class="fa-solid fa-plane-departure me-2"></i> Reservas realizadas Hotel-Aeropuerto
            </h5>
            <div class="table-responsive">
                <table class="table table-hover table-sm align-middle rounded shadow-sm">
                    <thead class="table-danger text-dark">
                        <tr>
                            <th>Realizada por</th>
                            <th>Localizador</th>
                            <th>Email cliente</th>
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
                            <td>{{ $returnBooking->destinoHotel->nombre_hotel }}</td>
                            <td>{{ $returnBooking->fecha_vuelo_salida }}</td>
                            <td>{{ $returnBooking->hora_vuelo_salida }}</td>
                            <td>{{ $returnBooking->hora_recogida_salida }}</td>
                            <td>{{ $returnBooking->num_viajeros }}</td>
                            <td>{{ $returnBooking->descripcionVehiculo->descripcion }}</td>
                            <td class="d-flex gap-2">
                                <button class="btn btn-outline-success btn-sm px-2 py-1 action-icon-btn" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editReturnModal" 
                                    onclick='fillEditReturnModal(@json($returnBooking))' 
                                    title="Editar">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <form action="{{ route('booking.destroyReturn', $returnBooking->id_reserva) }}" method="POST" 
                                    onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta reserva?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm px-2 py-1 action-icon-btn" type="submit" title="Eliminar">
                                        <i class="fa-solid fa-trash"></i>
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
            <h5 class="text-success mb-3">
                <i class="fa-solid fa-retweet me-2"></i> Reservas realizadas Ida-Vuelta
            </h5>
            <div class="table-responsive">
                <table class="table table-hover table-sm align-middle rounded shadow-sm">
                    <thead class="table-success text-dark">
                        <tr>
                            <th>Realizada por</th>
                            <th>Localizador</th>
                            <th>Email cliente</th>
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
                            <td class="d-flex gap-2">
                                <button class="btn btn-outline-success btn-sm px-2 py-1 action-icon-btn" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editRoundTripModal" 
                                    onclick='fillEditRoundTripModal(@json($roundTripBooking))' 
                                    title="Editar">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <form action="{{ route('booking.destroyRoundTrip', $roundTripBooking->id_reserva) }}" method="POST" 
                                    onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta reserva?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm px-2 py-1 action-icon-btn" type="submit" title="Eliminar">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
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
    function fillEditOneWayModal(booking) {
        //console.log(booking); // Verifica en consola que booking.id existe
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

    function fillEditReturnModal(booking) {
        //console.log(booking); // Verifica en consola que booking.id existe
        document.getElementById('editReturn_id').value = booking.id_reserva;
        document.getElementById('editReturn_fecha_salida').value = booking.fecha_vuelo_salida;
        document.getElementById('editReturn_hora_salida').value = booking.hora_vuelo_salida;
        document.getElementById('editReturn_hora_recogida_salida').value = booking.hora_recogida_salida;
        document.getElementById('editReturn_num_viajeros').value = booking.num_viajeros;
        document.getElementById('editReturn_id_vehiculo').value = booking.id_vehiculo;
        document.getElementById('editReturn_id_hotel').value = booking.id_destino;
        document.getElementById('editReturn_uuid').value = booking.localizador;
    }

    function fillEditRoundTripModal(booking) {
        console.log(booking); // Verifica en consola que booking.id existe
        document.getElementById('editRoundTrip_id').value = booking.id_reserva;
        document.getElementById('editRoundTrip_fecha_entrada').value = booking.fecha_entrada;
        document.getElementById('editRoundTrip_hora_entrada').value = booking.hora_entrada;
        document.getElementById('editRoundTrip_numero_vuelo_entrada').value = booking.numero_vuelo_entrada;
        document.getElementById('editRoundTrip_origen_vuelo_entrada').value = booking.origen_vuelo_entrada;
        document.getElementById('editRoundTrip_fecha_vuelo_salida').value = booking.fecha_vuelo_salida;
        document.getElementById('editRoundTrip_hora_vuelo_salida').value = booking.hora_vuelo_salida;
        document.getElementById('editRoundTrip_hora_recogida_salida').value = booking.hora_recogida_salida;
        document.getElementById('editRoundTrip_num_viajeros').value = booking.num_viajeros;
        document.getElementById('editRoundTrip_id_vehiculo').value = booking.id_vehiculo;
        document.getElementById('editRoundTrip_id_hotel').value = booking.id_destino;
        document.getElementById('editRoundTrip_tid_hotel').value = booking.id_destino;
        document.getElementById('editRoundTrip_uuid').value = booking.localizador;
    }
</script>

@endsection