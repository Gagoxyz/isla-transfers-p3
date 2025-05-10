@extends('layouts.app')

@section('title', 'Listado de reservas')

@section('content')
<div class="container py-4 mt-4">
    <h1 class="text-center fw-bold" style="color: #0056b3;">
    <i class="fa-solid fa-list-check me-2"></i> Listado de reservas registradas
    </h1>
    <p class="text-center text-muted fs-5 mb-4">Consulta y gestiona fácilmente las reservas realizadas</p>

    @if(session('success'))
        <div class="alert alert-success text-center shadow-sm">{{ session('success') }}</div>
    @endif

    <div class="card shadow-lg border-0" style="max-width: 1200px; margin: 0 auto;">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-dark border-bottom">
                        <tr>
                            <th>Localizador</th>
                            <th>Cliente</th>
                            <th>Fecha reserva</th>
                            <th>Última modificación</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservas as $reserva)
                        @php
                            $tipo_trayecto = 3;
                            if ($reserva->fecha_entrada && !$reserva->fecha_vuelo_salida) $tipo_trayecto = 1;
                            elseif (!$reserva->fecha_entrada && $reserva->fecha_vuelo_salida) $tipo_trayecto = 2;
                        @endphp
                        <tr>
                            <td class="fw-semibold text-uppercase">{{ $reserva->localizador }}</td>
                            <td>{{ $reserva->email_cliente }}</td>
                            <td>{{ $reserva->fecha_reserva }}</td>
                            <td>
                                @if($reserva->fecha_modificacion)
                                    {{ $reserva->fecha_modificacion }}
                                @else
                                    <span class="badge bg-secondary">Sin cambios</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <button class="btn btn-outline-primary btn-sm editAdminBtn"
                                            data-id="{{ $reserva->id_reserva }}"
                                            data-tipo="{{ $tipo_trayecto }}"
                                            style="border-color: #0056b3;">

                                        <i class="fa-solid fa-pen-to-square" ></i>
                                    </button>
                                    <form action="{{ route('admin.reserva.destroy', $reserva->id_reserva) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('¿Eliminar esta reserva?')">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('modals.edit_admin')
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $('.editAdminBtn').on('click', function () {
        const id = $(this).data('id');
        const tipo = parseInt($(this).data('tipo'));

        $('.campo-entrada').toggle(tipo !== 2);
        $('.campo-salida').toggle(tipo !== 1);

        fetch(`/admin/reserva/${id}`)
            .then(response => response.json())
            .then(reserva => {
                $('#editReservationForm').attr('action', `/admin/reserva/${id}`);
                $('#deleteReservationForm').attr('action', `/admin/reserva/${id}`);
                $('#reservaId').val(reserva.id_reserva);
                $('#tipoReservaEdit').val(reserva.id_tipo_reserva);
                $('#uuidEdit').val(reserva.localizador ?? '');
                $('#customerEmailEdit').val(reserva.email_cliente ?? '');
                $('#passengerNumEdit').val(reserva.num_viajeros ?? '');
                $('#hotelSelectEdit').val(reserva.id_destino ?? '');
                $('#carSelectEdit').val(reserva.id_vehiculo ?? '');
                $('#bookingDateEdit').val(reserva.fecha_entrada?.substring(0, 10) ?? '');
                $('#bookingTimeEdit').val(reserva.hora_entrada?.substring(0, 5) ?? '');
                $('#flyNumerEdit').val(reserva.numero_vuelo_entrada ?? '');
                $('#originAirportEdit').val(reserva.origen_vuelo_entrada ?? '');
                $('#dateFlyEdit').val(reserva.fecha_vuelo_salida?.substring(0, 10) ?? '');
                $('#timeFlyEdit').val(reserva.hora_vuelo_salida?.substring(0, 5) ?? '');
                $('#pickupTimeEdit').val(reserva.hora_recogida_salida?.substring(0, 5) ?? '');
                $('#editModal').modal('show');
            });
    });
});
</script>
@endpush
