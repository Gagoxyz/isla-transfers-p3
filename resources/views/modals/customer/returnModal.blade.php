@php
use Illuminate\Support\Str;
$uuid = Str::random(7);
@endphp

<div class="modal fade" id="returnModal" tabindex="-1" aria-labelledby="returnModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-danger shadow">
            <div class="modal-header bg-danger text-white rounded-top-4">
                <h5 class="modal-title" id="returnModalLabel">
                    <i class="fa-solid fa-plane-departure me-2"></i> Nueva reserva (Hotel → Aeropuerto)
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('booking.return') }}" method="POST">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="ruuid" class="form-label">Localizador</label>
                            <input type="text" id="ruuid" name="ruuid" class="form-control" value="{{ $uuid }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="remail_cliente" class="form-label">Email</label>
                            <input type="email" id="remail_cliente" name="remail_cliente" class="form-control" value="{{ session('email') }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="rfecha_vuelo_salida" class="form-label">Día de salida</label>
                            <input type="date" name="rfecha_vuelo_salida" id="rfecha_vuelo_salida" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="rhora_vuelo_salida" class="form-label">Hora de salida</label>
                            <input type="time" name="rhora_vuelo_salida" id="rhora_vuelo_salida" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="rhora_recogida_salida" class="form-label">Hora de recogida</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-clock"></i></span>
                                <input type="time" name="rhora_recogida_salida" id="rhora_recogida_salida" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="rid_hotel" class="form-label">Hotel de destino</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-hotel"></i></span>
                                <select class="form-select" name="rid_hotel" id="rid_hotel" required>
                                    <option selected disabled>Seleccionar...</option>
                                    @foreach ($hoteles as $hotel)
                                    <option value="{{ $hotel->id_hotel }}">{{ $hotel->nombre_hotel }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="rid_vehiculo" class="form-label">Vehículo</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-car"></i></span>
                                <select class="form-select" name="rid_vehiculo" id="rid_vehiculo" required>
                                    <option selected disabled>Seleccionar...</option>
                                    @foreach ($vehiculos as $vehiculo)
                                    <option value="{{ $vehiculo->id_vehiculo }}">{{ $vehiculo->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="rnum_viajeros" class="form-label">Número de pasajeros</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-users"></i></span>
                                <input type="number" name="rnum_viajeros" id="rnum_viajeros" class="form-control" required min="1">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">
                            <i class="fa-solid fa-xmark me-1"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-danger shadow-sm">
                            <i class="fa-solid fa-check me-1"></i> Confirmar reserva
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
