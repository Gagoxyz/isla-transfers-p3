@extends('layouts.app')

@section('title', 'Bienvenido')

@include('modals.hotel.oneWayModal')
@include('modals.hotel.returnModal')
@include('modals.hotel.roundTripModal')
@include('modals.hotel.editOneWayModal')
@include('modals.hotel.editReturnModal')
@include('modals.hotel.editRoundTripModal')


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
                    <button class="btn btn-warning btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#editOneWayModal"
                            data-id="{{ $oneWayBooking->id_reserva}}"
                            data-localizador="{{ $oneWayBooking->localizador }}"
                            data-email="{{ $oneWayBooking->email_cliente }}"
                            data-vuelo="{{ $oneWayBooking->numero_vuelo_entrada }}"
                            data-fecha="{{ $oneWayBooking->fecha_entrada }}"
                            data-hora="{{ $oneWayBooking->hora_entrada }}"
                            data-origen="{{ $oneWayBooking->origen_vuelo_entrada }}"
                            data-pasajeros="{{ $oneWayBooking->num_viajeros }}"
                            data-vehiculo="{{ $oneWayBooking->id_vehiculo }}">
                        <i class="fa-solid fa-pen-to-square"></i> Editar
                    </button>

                    <form method="POST" action="{{ route('hotel.reserva.destroy', $oneWayBooking->id_reserva) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('¿Eliminar esta reserva?')">
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
                    <button class="btn btn-warning btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#editReturnModal"
                            data-id="{{ $returnBooking->id_reserva }}"
                            data-email="{{ $returnBooking->email_cliente }}"
                            data-fecha="{{ $returnBooking->fecha_vuelo_salida }}"
                            data-hora="{{ $returnBooking->hora_vuelo_salida }}"
                            data-hora-recogida="{{ $returnBooking->hora_recogida_salida }}"
                            data-pasajeros="{{ $returnBooking->num_viajeros }}"
                            data-vehiculo="{{ $returnBooking->id_vehiculo }}">
                        <i class="fa-solid fa-pen-to-square"></i> Editar
                    </button>

                    <form method="POST" action="{{ route('hotel.reserva.destroy', $returnBooking->id_reserva) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('¿Eliminar esta reserva de vuelta?')">
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
                    <button class="btn btn-warning btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#editRoundTripModal"
                            data-id="{{ $roundTripBooking->id_reserva }}"
                            data-email="{{ $roundTripBooking->email_cliente }}"
                            data-vuelo="{{ $roundTripBooking->numero_vuelo_entrada }}"
                            data-fecha-entrada="{{ $roundTripBooking->fecha_entrada }}"
                            data-hora-entrada="{{ $roundTripBooking->hora_entrada }}"
                            data-origen="{{ $roundTripBooking->origen_vuelo_entrada }}"
                            data-fecha-salida="{{ $roundTripBooking->fecha_vuelo_salida }}"
                            data-hora-salida="{{ $roundTripBooking->hora_vuelo_salida }}"
                            data-hora-recogida="{{ $roundTripBooking->hora_recogida_salida }}"
                            data-pasajeros="{{ $roundTripBooking->num_viajeros }}"
                            data-vehiculo="{{ $roundTripBooking->id_vehiculo }}">
                        <i class="fa-solid fa-pen-to-square"></i> Editar
                    </button>
                    <form method="POST" action="{{ route('hotel.reserva.destroy', $roundTripBooking->id_reserva) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('¿Eliminar esta reserva ida-vuelta?')">
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

@push('scripts')
<script>
    //ida
    document.addEventListener('DOMContentLoaded', function () {

        const modalElement = document.getElementById('editOneWayModal');
        const modal = new bootstrap.Modal(modalElement);

        document.querySelectorAll('[data-bs-target="#editOneWayModal"]').forEach(button => {
            button.addEventListener('click', function () {
                console.log("BOTÓN DETECTADO", {
                    id: this.dataset.id,
                    email: this.dataset.email,
                    vuelo: this.dataset.vuelo,
                });

                document.getElementById('edit-id-oneway').value = this.dataset.id;
                document.getElementById('edit-email-oneway').value = this.dataset.email;
                document.getElementById('edit-vuelo-oneway').value = this.dataset.vuelo;
                document.getElementById('edit-fecha-oneway').value = this.dataset.fecha;
                document.getElementById('edit-hora-oneway').value = this.dataset.hora;
                document.getElementById('edit-origen-oneway').value = this.dataset.origen;
                document.getElementById('edit-pasajeros-oneway').value = this.dataset.pasajeros;
                document.getElementById('edit-vehiculo-oneway').value = this.dataset.vehiculo;

                modal.show();
            });
        });
    });
</script>
<script>
    //vuelta
    document.querySelectorAll('[data-bs-target="#editReturnModal"]').forEach(button => {
        button.addEventListener('click', function () {
            console.log("Edit Return Modal:", this.dataset);

            document.getElementById('edit-id-return').value = this.dataset.id;
            document.getElementById('edit-email-return').value = this.dataset.email;
            document.getElementById('edit-fecha-salida-return').value = this.dataset.fecha;
            document.getElementById('edit-hora-salida-return').value = this.dataset.hora;
            document.getElementById('edit-hora-recogida-return').value = this.dataset.horaRecogida;
            document.getElementById('edit-pasajeros-return').value = this.dataset.pasajeros;
            document.getElementById('edit-vehiculo-return').value = this.dataset.vehiculo;
        });
    });
</script>

<script>
    //Ida y vuelta
    document.querySelectorAll('[data-bs-target="#editRoundTripModal"]').forEach(button => {
        button.addEventListener('click', function () {
            console.log("Edit RoundTrip Modal:", this.dataset);

            document.getElementById('edit-id-roundtrip').value = this.dataset.id;
            document.getElementById('edit-email-roundtrip').value = this.dataset.email;
            document.getElementById('edit-vuelo-roundtrip').value = this.dataset.vuelo;
            document.getElementById('edit-fecha-entrada-roundtrip').value = this.dataset.fechaEntrada;
            document.getElementById('edit-hora-entrada-roundtrip').value = this.dataset.horaEntrada;
            document.getElementById('edit-origen-roundtrip').value = this.dataset.origen;
            document.getElementById('edit-fecha-salida-roundtrip').value = this.dataset.fechaSalida;
            document.getElementById('edit-hora-salida-roundtrip').value = this.dataset.horaSalida;
            document.getElementById('edit-hora-recogida-roundtrip').value = this.dataset.horaRecogida;
            document.getElementById('edit-pasajeros-roundtrip').value = this.dataset.pasajeros;
            document.getElementById('edit-vehiculo-roundtrip').value = this.dataset.vehiculo;
        });
    });
</script>


@endpush
