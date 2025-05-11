@extends('layouts.app')

@section('title', 'Hotel - Administración')

@include('modals.hotel.oneWayModal')
@include('modals.hotel.returnModal')
@include('modals.hotel.roundTripModal')
@include('modals.hotel.editOneWayModal')
@include('modals.hotel.editReturnModal')
@include('modals.hotel.editRoundTripModal')

@section('content')
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

        <h2 class="text-center fw-bold mb-4 text-warning">
            <i class="fa-solid fa-hotel me-2"></i> Panel de administración CORPORATIVO
        </h2>
        <p class="text-center text-muted fs-5">Gestión de reservas desde el panel del hotel</p>


        <div class="d-flex flex-wrap justify-content-center gap-3 mb-4">
            <button type="button" class="btn btn-outline-primary fw-bold shadow-sm d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#hotelOneWayModal">
                <i class="fa-solid fa-circle-plus me-2"></i> Aeropuerto-Hotel
            </button>
            <button type="button" class="btn btn-outline-danger fw-bold shadow-sm d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#hotelReturnModal">
                <i class="fa-solid fa-circle-plus me-2"></i> Hotel-Aeropuerto
            </button>
            <button type="button" class="btn btn-outline-success fw-bold shadow-sm d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#hotelRoundTripModal">
                <i class="fa-solid fa-circle-plus me-2"></i> Ida y vuelta
            </button>
        </div>

        <hr class="text-primary">

        {{-- Tabla Aeropuerto-Hotel --}}
        <div class="mt-5">
            <h5 class="text-primary mb-3"><i class="fa-solid fa-plane-arrival me-2"></i> Reservas Aeropuerto-Hotel</h5>
            <div class="table-responsive">
                <table class="table table-hover table-sm align-middle rounded shadow-sm">
                    <thead class="table-primary text-dark">
                        <tr>
                            <th>Localizador</th>
                            <th>Email cliente</th>
                            <th>Número vuelo</th>
                            <th>Fecha llegada</th>
                            <th>Hora llegada</th>
                            <th>Origen</th>
                            <th>Pasajeros</th>
                            <th>Vehículo</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($oneWayBookings as $booking)
                        <tr>
                            <td>{{ $booking->localizador }}</td>
                            <td>{{ $booking->email_cliente }}</td>
                            <td>{{ $booking->numero_vuelo_entrada }}</td>
                            <td>{{ $booking->fecha_entrada }}</td>
                            <td>{{ $booking->hora_entrada }}</td>
                            <td>{{ $booking->origen_vuelo_entrada }}</td>
                            <td>{{ $booking->num_viajeros }}</td>
                            <td>{{ $booking->descripcionVehiculo->descripcion }}</td>
                            <td class="d-flex gap-2">
                                <button class="btn btn-outline-warning btn-sm d-flex align-items-center justify-content-center px-2 py-1"
                                        style="width: 32px; height: 32px;"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editOneWayModal"
                                        data-id="{{ $booking->id_reserva }}"
                                        data-email="{{ $booking->email_cliente }}"
                                        data-vuelo="{{ $booking->numero_vuelo_entrada }}"
                                        data-fecha="{{ $booking->fecha_entrada }}"
                                        data-hora="{{ $booking->hora_entrada }}"
                                        data-origen="{{ $booking->origen_vuelo_entrada }}"
                                        data-pasajeros="{{ $booking->num_viajeros }}"
                                        data-vehiculo="{{ $booking->id_vehiculo }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <form action="{{ route('hotel.reserva.destroy', $booking->id_reserva) }}" method="POST" onsubmit="return confirm('¿Eliminar esta reserva?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm d-flex align-items-center justify-content-center px-2 py-1"
                                            style="width: 32px; height: 32px;" type="submit">
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

        {{-- Tabla Hotel-Aeropuerto --}}
        <div class="mt-5">
            <h5 class="text-danger mb-3"><i class="fa-solid fa-plane-departure me-2"></i> Reservas Hotel-Aeropuerto</h5>
            <div class="table-responsive">
                <table class="table table-hover table-sm align-middle rounded shadow-sm">
                    <thead class="table-danger text-dark">
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
                        @foreach ($returnBookings as $booking)
                        <tr>
                            <td>{{ $booking->localizador }}</td>
                            <td>{{ $booking->email_cliente }}</td>
                            <td>{{ $booking->fecha_vuelo_salida }}</td>
                            <td>{{ $booking->hora_vuelo_salida }}</td>
                            <td>{{ $booking->hora_recogida_salida }}</td>
                            <td>{{ $booking->num_viajeros }}</td>
                            <td>{{ $booking->descripcionVehiculo->descripcion }}</td>
                            <td class="d-flex gap-2">
                                <button class="btn btn-outline-warning btn-sm d-flex align-items-center justify-content-center px-2 py-1"
                                        style="width: 32px; height: 32px;"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editReturnModal"
                                        data-id="{{ $booking->id_reserva }}"
                                        data-email="{{ $booking->email_cliente }}"
                                        data-fecha="{{ $booking->fecha_vuelo_salida }}"
                                        data-hora="{{ $booking->hora_vuelo_salida }}"
                                        data-hora-recogida="{{ $booking->hora_recogida_salida }}"
                                        data-pasajeros="{{ $booking->num_viajeros }}"
                                        data-vehiculo="{{ $booking->id_vehiculo }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <form action="{{ route('hotel.reserva.destroy', $booking->id_reserva) }}" method="POST" onsubmit="return confirm('¿Eliminar esta reserva?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm d-flex align-items-center justify-content-center px-2 py-1"
                                            style="width: 32px; height: 32px;" type="submit">
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

        {{-- Tabla Ida-Vuelta --}}
        <div class="mt-5">
            <h5 class="text-success mb-3"><i class="fa-solid fa-retweet me-2"></i> Reservas Ida-Vuelta</h5>
            <div class="table-responsive">
                <table class="table table-hover table-sm align-middle rounded shadow-sm">
                    <thead class="table-success text-dark">
                        <tr>
                            <th>Localizador</th>
                            <th>Email cliente</th>
                            <th>Vuelo llegada</th>
                            <th>Fecha llegada</th>
                            <th>Hora llegada</th>
                            <th>Origen</th>
                            <th>Fecha salida</th>
                            <th>Hora salida</th>
                            <th>Hora recogida</th>
                            <th>Pasajeros</th>
                            <th>Vehículo</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roundTripBookings as $booking)
                        <tr>
                            <td>{{ $booking->localizador }}</td>
                            <td>{{ $booking->email_cliente }}</td>
                            <td>{{ $booking->numero_vuelo_entrada }}</td>
                            <td>{{ $booking->fecha_entrada }}</td>
                            <td>{{ $booking->hora_entrada }}</td>
                            <td>{{ $booking->origen_vuelo_entrada }}</td>
                            <td>{{ $booking->fecha_vuelo_salida }}</td>
                            <td>{{ $booking->hora_vuelo_salida }}</td>
                            <td>{{ $booking->hora_recogida_salida }}</td>
                            <td>{{ $booking->num_viajeros }}</td>
                            <td>{{ $booking->descripcionVehiculo->descripcion }}</td>
                            <td class="d-flex gap-2">
                            <button class="btn btn-outline-warning btn-sm d-flex align-items-center justify-content-center px-2 py-1" style="width: 32px; height: 32px;" data-bs-toggle="modal" data-bs-target="#editRoundTripModal"
                                data-id="{{ $booking->id_reserva }}"
                                data-email="{{ $booking->email_cliente }}"
                                data-vuelo="{{ $booking->numero_vuelo_entrada }}"
                                data-fecha-entrada="{{ $booking->fecha_entrada }}"
                                data-hora-entrada="{{ $booking->hora_entrada }}"
                                data-origen="{{ $booking->origen_vuelo_entrada }}"
                                data-fecha-salida="{{ $booking->fecha_vuelo_salida }}"
                                data-hora-salida="{{ $booking->hora_vuelo_salida }}"
                                data-hora-recogida="{{ $booking->hora_recogida_salida }}"
                                data-pasajeros="{{ $booking->num_viajeros }}"
                                data-vehiculo="{{ $booking->id_vehiculo }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <form action="{{ route('hotel.reserva.destroy', $booking->id_reserva) }}" method="POST" onsubmit="return confirm('¿Eliminar esta reserva?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm d-flex align-items-center justify-content-center px-2 py-1" style="width: 32px; height: 32px;" type="submit">
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
