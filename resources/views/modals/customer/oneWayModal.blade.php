@php
use Illuminate\Support\Str;
$uuid = Str::random(7);
@endphp

<div class="modal fade" id="oneWayModal" tabindex="-1" aria-labelledby="oneWayModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-primary shadow rounded-4">
            <div class="modal-header bg-primary text-white rounded-top-4">
                <h5 class="modal-title" id="oneWayModalLabel">
                    <i class="fa-solid fa-plane-arrival me-2"></i> Nueva reserva (Aeropuerto → Hotel)
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('booking.oneWay') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="uuid" class="form-label">Localizador</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-barcode"></i></span>
                                <input type="text" id="uuid" name="uuid" class="form-control" value="{{ $uuid }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="email_cliente" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                <input type="text" id="email_cliente" name="email_cliente" class="form-control" value="{{ session('email') }}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="fecha_entrada" class="form-label">Día de llegada</label>
                            <input type="date" name="fecha_entrada" id="fecha_entrada" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="hora_entrada" class="form-label">Hora de llegada</label>
                            <input type="time" name="hora_entrada" id="hora_entrada" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="numero_vuelo_entrada" class="form-label">Número de vuelo</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-plane"></i></span>
                                <input type="text" name="numero_vuelo_entrada" id="numero_vuelo_entrada" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="origen_vuelo_entrada" class="form-label">Aeropuerto de origen</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span>
                                <input type="text" name="origen_vuelo_entrada" id="origen_vuelo_entrada" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="id_hotel" class="form-label">Hotel de destino</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-hotel"></i></span>
                                <select class="form-select" name="id_hotel" id="id_hotel" required>
                                    <option value="">Seleccionar...</option>
                                    @foreach ($hoteles as $hotel)
                                    <option value="{{ $hotel->id_hotel }}">{{ $hotel->nombre_hotel }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="id_vehiculo" class="form-label">Vehículo</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-car"></i></span>
                                <select class="form-select" name="id_vehiculo" id="id_vehiculo" required>
                                    <option value="">Seleccionar...</option>
                                    @foreach ($vehiculos as $vehiculo)
                                    <option value="{{ $vehiculo->id_vehiculo }}">{{ $vehiculo->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="num_viajeros" class="form-label">Número de pasajeros</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-users"></i></span>
                            <input type="number" name="num_viajeros" id="num_viajeros" class="form-control" required min="1">
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">
                            <i class="fa-solid fa-xmark me-1"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary shadow-sm">
                            <i class="fa-solid fa-check me-1"></i> Confirmar reserva
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
