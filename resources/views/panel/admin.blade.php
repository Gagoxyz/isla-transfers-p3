@extends('layouts.app')

@section('title', 'Bienvenido')

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
{{-- @include('modals.select_reservation_type') --}}S
{{-- @include('modals.edit_admin') --}}
@endsection

@push('scripts')
<!-- FullCalendar -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/locales-all.global.min.js'></script>

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
                const reservaId = info.event.extendedProps.id_reserva;
                console.log('Reserva clicada ID:', reservaId);
            }
        });

        calendar.render();
    });
</script>
@endpush
