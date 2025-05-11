@extends('layouts.app')

@section('title', 'Comisiones de Hoteles')

@section('content')
<div class="container py-4 mt-4">
    <h2 class="text-center fw-bold mb-2" style="color: #0056b3;">
        <i class="fa-solid fa-chart-column me-2"></i> Comisiones de hoteles - {{ $mes }}
    </h2>
    <p class="text-center text-muted fs-5 mb-4">Resumen de comisiones generadas por reservas</p>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            @if($hoteles->isEmpty())
            <div class="alert alert-info mb-0" role="alert">
                <i class="fa-solid fa-info-circle me-2"></i> No hay comisiones registradas este mes.
            </div>
            @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-dark border-bottom">
                        <tr>
                            <th>Hotel</th>
                            <th>Email</th>
                            <th>Zona</th>
                            <th>Reservas</th>
                            <th>Comisión (%)</th>
                            <th>Total Comisión</th>
                            <th class="text-center">Reservas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hoteles as $hotel)
                        <tr>
                            <td class="fw-semibold">{{ $hotel->nombre_hotel }}</td>
                            <td>{{ $hotel->email_hotel }}</td>
                            <td>{{ optional($hotel->zona)->descripcion ?? 'Sin zona' }}</td>
                            <td>{{ $hotel->reservas->count() }}</td>
                            <td>{{ $hotel->comision }}%</td>
                            <td class="fw-bold text-success">{{ number_format($hotel->comision_total, 2) }} €</td>
                            <td class="text-center">
                                <button type="button"
                                    class="btn btn-sm btn-outline-success shadow-sm verReservasBtn"
                                    title="Ver reservas"
                                    data-nombre="{{ $hotel->nombre_hotel }}"
                                    data-reservas='@json($hotel->reservas_resumen)'>
                                    <i class="fa-solid fa-magnifying-glass"></i>
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

<!-- Modal -->
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
                                <th>Fecha</th>
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
                <span class="text-muted small">Mostrando todas las reservas del mes actual.</span>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

@endsection

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
                    <td class="text-end">${parseFloat(r.precio).toFixed(2)} €</td>
                    <td class="text-end">${parseFloat(r.comision).toFixed(2)} €</td>
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
