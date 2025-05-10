@extends('layouts.app')

@section('title', 'Administración')
@include('modals.edit_admin')
@section('content')
<div class="container py-3 mt-5">
    <h1 class="pb-5 row justify-content-center">Panel de administración ADMIN</h1>
    <div class="row justify-content-center">
        <div class="col-auto">
            <button type="button" class="btn text-white fw-bold" style="background-color: #007bff;"
                data-bs-toggle="modal" data-bs-target="#oneWayAdminModal">
                <i class="fa-solid fa-circle-plus"></i> Reservar Aeropuerto-Hotel
            </button>
            <button type="button" class="btn text-white fw-bold" style="background-color: #dc3545;"
                data-bs-toggle="modal" data-bs-target="#returnAdminModal">
                <i class="fa-solid fa-circle-plus"></i> Reservar Hotel-Aeropuerto
            </button>
            <button type="button" class="btn text-white fw-bold" style="background-color: #28a745;"
                data-bs-toggle="modal" data-bs-target="#roundTripAdminModal">
                <i class="fa-solid fa-circle-plus"></i> Reservar ida-vuelta (Aeropuerto-Hotel/Hotel-Aeropuerto)
            </button>
        </div>
    </div>
    <hr>
    <div class="p-3" id='calendar' style="min-height: 600px; max-width: 1200px; margin: 0 auto;"></div>
</div>
<!-- Modales -->
@include('modals.one_way_admin')
@include('modals.return_admin')
@include('modals.round_trip_admin')
{{-- @include('modals.select_reservation_type') --}}
@include('modals.edit_admin')
@endsection

@push('scripts')
<!-- FullCalendar -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/locales-all.global.min.js'></script>
<!-- jQuery (requerido para los modales y selects dinámicos) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');

        const calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'es',
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            buttonText: {
                today: 'hoy',
                month: 'mes',
                week: 'semana',
                day: 'día'
            },
            events: '/api/reservas',
            eventDisplay: 'list-item',
            eventDidMount: function(info) {
                if (info.event.extendedProps && info.event.extendedProps.tooltip) {
                    info.el.setAttribute('title', info.event.extendedProps.tooltip);
                }
            },
            dateClick: function(info) {
                const date = new Date(info.dateStr);
                const formattedDate = date.toISOString().split('T')[0];
                console.log('Fecha seleccionada:', formattedDate);
            },
            eventClick: function(info) {
            // Extrae el ID numérico (antes del guión)
            const rawId = info.event.id;
            const reservaId = rawId.split('-')[0];

            const tipoReserva = info.event.extendedProps.tipo_trayecto;

            // Mostrar/ocultar campos según el tipo
            if (tipoReserva == 1) {
                $('.campo-entrada').show();
                $('.campo-salida').hide();
            } else if (tipoReserva == 2) {
                $('.campo-entrada').hide();
                $('.campo-salida').show();
            } else {
                $('.campo-entrada').show();
                $('.campo-salida').show();
            }

            fetch(`/admin/reserva/${reservaId}`)
            .then(response => response.json())
            .then(reserva => {
                $('#editReservationForm').attr('action', `/admin/reserva/${reservaId}`);
                $('#deleteReservationForm').attr('action', `/admin/reserva/${reservaId}`);
                $('#reservaId').val(reserva.id_reserva);
                $('#tipoReservaEdit').val(reserva.id_tipo_reserva);

                // Datos comunes
                $('#uuidEdit').val(reserva.localizador ?? '');
                $('#customerEmailEdit').val(reserva.email_cliente ?? '');
                $('#passengerNumEdit').val(reserva.num_viajeros ?? '');
                $('#hotelSelectEdit').val(reserva.id_destino ?? '');
                $('#carSelectEdit').val(reserva.id_vehiculo ?? '');

                // Entrada (Aeropuerto -> Hotel)
                $('#bookingDateEdit').val(reserva.fecha_entrada ? reserva.fecha_entrada.substring(0, 10) : '');
                $('#bookingTimeEdit').val(reserva.hora_entrada ? reserva.hora_entrada.substring(0, 5) : '');
                $('#flyNumerEdit').val(reserva.numero_vuelo_entrada ?? '');
                $('#originAirportEdit').val(reserva.origen_vuelo_entrada ?? '');

                // Salida (Hotel -> Aeropuerto)
                $('#dateFlyEdit').val(reserva.fecha_vuelo_salida ? reserva.fecha_vuelo_salida.substring(0, 10) : '');
                $('#timeFlyEdit').val(reserva.hora_vuelo_salida ? reserva.hora_vuelo_salida.substring(0, 5) : '');
                $('#pickupTimeEdit').val(reserva.hora_recogida_salida ? reserva.hora_recogida_salida.substring(0, 5) : '');

                $('#editModal').modal('show');
            });


        }


             });

        calendar.render();
    });
</script>
@endpush