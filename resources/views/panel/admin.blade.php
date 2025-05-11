@extends('layouts.app')

@section('title', 'Administración')
@include('modals.edit_admin')

@section('content')
<div class="container py-4 mt-4">
    <h1 class="text-center fw-bold">Panel de administración</h1>
    <p class="text-center text-muted fs-5 mb-4">Gestión avanzada de reservas</p>

    <div class="d-flex flex-wrap justify-content-center gap-3 mb-4">
        <button class="btn btn-primary btn-lg shadow-sm"
            data-bs-toggle="modal" data-bs-target="#oneWayAdminModal">
            <i class="fa-solid fa-plane-arrival me-2"></i> Aeropuerto - Hotel
        </button>
        <button class="btn btn-danger btn-lg shadow-sm"
            data-bs-toggle="modal" data-bs-target="#returnAdminModal">
            <i class="fa-solid fa-plane-departure me-2"></i> Hotel - Aeropuerto
        </button>
        <button class="btn btn-success btn-lg shadow-sm"
            data-bs-toggle="modal" data-bs-target="#roundTripAdminModal">
            <i class="fa-solid fa-retweet me-2"></i> Ida y Vuelta
        </button>
        <a href="{{ url('/admin/estadisticas-zonas') }}" target="_blank"
            class="btn btn-secondary btn-lg shadow-sm">
            <i class="fa-solid fa-chart-bar me-2"></i> Ver estadísticas (JSON)
        </a>
    </div>

    <div class="card shadow-lg mb-5" style="max-width: 1200px; margin: 0 auto;">
        <div class="card-body p-4">
            <div id="calendar" style="min-height: 600px;"></div>
        </div>
    </div>
</div>

<!-- Modales -->
@include('modals.one_way_admin')
@include('modals.return_admin')
@include('modals.round_trip_admin')
@include('modals.edit_admin')
@endsection

@push('scripts')
<!-- FullCalendar -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/locales-all.global.min.js'></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    const BASE_URL = "{{ url('/') }}";
    document.addEventListener('DOMContentLoaded', function() {
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
            events: `${BASE_URL}/api/reservas`,
            eventDisplay: 'list-item',
            eventDidMount: function(info) {
                if (info.event.extendedProps?.tooltip) {
                    info.el.setAttribute('title', info.event.extendedProps.tooltip);
                }
            },
            dateClick: function(info) {
                const formattedDate = new Date(info.dateStr).toISOString().split('T')[0];
                console.log('Fecha seleccionada:', formattedDate);
            },
            eventClick: function(info) {
                const reservaId = info.event.id.split('-')[0];
                const tipoReserva = info.event.extendedProps.tipo_trayecto;

                $('.campo-entrada').toggle(tipoReserva != 2);
                $('.campo-salida').toggle(tipoReserva != 1);

                fetch(`${BASE_URL}/admin/reserva/${reservaId}`)
                    .then(response => response.json())
                    .then(reserva => {
                        $('#editReservationForm').attr('action', `${BASE_URL}/admin/reserva/${reservaId}`);
                        $('#deleteReservationForm').attr('action', `${BASE_URL}/admin/reserva/${reservaId}`);
                        $('#reservaId').val(reserva.id_reserva);
                        console.log('Tipo de reserva cargado:', reserva.id_tipo_reserva);
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
            }
        });

        calendar.render();
    });
</script>
@endpush