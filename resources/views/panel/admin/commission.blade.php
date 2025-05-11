@extends('layouts.app')

@section('title', 'Comisiones de Hoteles')

@section('content')
<div class="container mt-5">
    <h2 class="fw-bold text-primary mb-4">
        <i class="fa-solid fa-chart-column me-2"></i>Comisiones de hoteles - {{ $mes }}
    </h2>

    <div class="card shadow-sm">
        <div class="card-body">
            @if($hoteles->isEmpty())
            <div class="alert alert-info mb-0" role="alert">
                No hay comisiones registradas este mes.
            </div>
            @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>Hotel</th>
                            <th>Email</th>
                            <th>Zona</th>
                            <th>Cantidad de reservas</th>
                            <th>Comisión pactada (%)</th>
                            <th>Total Comisión del Mes</th>
                            <th>Listado reservas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hoteles as $hotel)
                        <tr>
                            <td>{{ $hotel->nombre_hotel }}</td>
                            <td>{{ $hotel->email_hotel }}</td>
                            <td>{{ optional($hotel->zona)->descripcion }}</td>
                            <td>{{ $hotel->reservas->count() }}</td>
                            <td>{{ $hotel->comision }}%</td>
                            <td class="fw-bold text-success">{{ number_format($hotel->comision_total, 2) }} €</td>
                            <td>
                                <button type="button"
                                    class="btn btn-sm btn-success verReservasBtn"
                                    data-nombre="{{ $hotel->nombre_hotel }}"
                                    data-reservas='@json($hotel->reservas_resumen)'>
                                    Ver reservas
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>


<!-- Modal para mostrar listado de reservas por hotel -->
<div class="modal fade" id="reservasModal" tabindex="-1" aria-labelledby="reservasModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content shadow-lg rounded-4">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold" id="reservasModalLabel">
                    <i class="fa-solid fa-list me-2"></i>Reservas de <span id="modalHotelName"></span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Localizador</th>
                                <th>Cliente</th>
                                <th>Fecha Reserva</th>
                                <th>Vehículo</th>
                                <th class="text-end">Precio</th>
                                <th class="text-end">Comisión</th>
                            </tr>
                        </thead>
                        <tbody id="modalReservasBody">
                            <!-- Se rellenará dinámicamente -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <span class="text-muted small">Mostrando todas las reservas de este mes.</span>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


@push('scripts')
<script>
    document.querySelectorAll('.verReservasBtn').forEach(btn => {
        btn.addEventListener('click', () => {
            const nombreHotel = btn.dataset.nombre;
            const reservas = JSON.parse(btn.dataset.reservas);
            const tbody = document.getElementById('modalReservasBody');
            tbody.innerHTML = '';

            reservas.forEach(r => {
                const row = `<tr>
                <td>${r.localizador}</td>
                <td>${r.email_cliente}</td>
                <td>${r.fecha_reserva}</td>
                <td>${r.vehiculo}</td>
                <td>${r.precio} €</td>
                <td>${r.comision} €</td>
            </tr>`;
                tbody.insertAdjacentHTML('beforeend', row);
            });

            document.getElementById('modalHotelName').textContent = nombreHotel;
            const modal = new bootstrap.Modal(document.getElementById('reservasModal'));
            modal.show();
        });
    });
</script>
@endpush

@endsection