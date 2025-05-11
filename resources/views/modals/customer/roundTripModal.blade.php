@php
use Illuminate\Support\Str;
$uuid = Str::random(7);
@endphp

<div class="modal fade" id="roundTripModal" tabindex="-1" aria-labelledby="roundTripModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-success shadow rounded-4">
            <div class="modal-header bg-success text-white rounded-top-4">
                <h5 class="modal-title" id="roundTripModalLabel">
                    <i class="fa-solid fa-retweet me-2"></i> Nueva reserva (Ida-Vuelta / Aeropuerto → Hotel)
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                <form action="{{ route('booking.roundTrip') }}" method="POST">
                    @csrf

                    <h6 class="mb-3 text-success"><i class="fa-solid fa-plane-arrival me-1"></i> Datos de entrada</h6>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="rtuuid" class="form-label">Localizador</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-barcode"></i></span>
                                <input type="text" id="rtuuid" name="rtuuid" class="form-control" value="{{ $uuid }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="rtemail_cliente" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                <input type="text" id="rtemail_cliente" name="rtemail_cliente" class="form-control" value="{{ session('email') }}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="rtfecha_entrada" class="form-label">Día de llegada</label>
                            <input type="date" name="rtfecha_entrada" id="rtfecha_entrada" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="rthora_entrada" class="form-label">Hora de llegada</label>
                            <input type="time" name="rthora_entrada" id="rthora_entrada" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="rtnumero_vuelo_entrada" class="form-label">Número de vuelo</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-plane"></i></span>
                                <input type="text" name="rtnumero_vuelo_entrada" id="rtnumero_vuelo_entrada" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="rtorigen_vuelo_entrada" class="form-label">Aeropuerto de origen</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span>
                                <input type="text" name="rtorigen_vuelo_entrada" id="rtorigen_vuelo_entrada" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="rtid_hotel" class="form-label">Hotel de destino</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-hotel"></i></span>
                            <select class="form-select" name="rtid_hotel" id="rtid_hotel" required>
                                <option value="">Seleccionar...</option>
                                @foreach ($hoteles as $hotel)
                                <option value="{{ $hotel->id_hotel }}">{{ $hotel->nombre_hotel }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <hr class="text-success">

                    <h6 class="mb-3 text-success"><i class="fa-solid fa-plane-departure me-1"></i> Datos de salida</h6>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="rtfecha_vuelo_salida" class="form-label">Día de salida</label>
                            <input type="date" name="rtfecha_vuelo_salida" id="rtfecha_vuelo_salida" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="rthora_vuelo_salida" class="form-label">Hora de salida</label>
                            <input type="time" name="rthora_vuelo_salida" id="rthora_vuelo_salida" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="rthora_recogida_salida" class="form-label">Hora de recogida</label>
                            <input type="time" name="rthora_recogida_salida" id="rthora_recogida_salida" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="rttid_hotel" class="form-label">Hotel de destino</label>
                            <select class="form-select" name="rttid_hotel" id="rttid_hotel" required>
                                <option value="">Seleccionar...</option>
                                @foreach ($hoteles as $hotel)
                                <option value="{{ $hotel->id_hotel }}">{{ $hotel->nombre_hotel }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="rtid_vehiculo" class="form-label">Vehículo</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-car"></i></span>
                                <select class="form-select" name="rtid_vehiculo" id="rtid_vehiculo" required>
                                    <option value="">Seleccionar...</option>
                                    @foreach ($vehiculos as $vehiculo)
                                    <option value="{{ $vehiculo->id_vehiculo }}">{{ $vehiculo->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="rtnum_viajeros" class="form-label">Número de pasajeros</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-users"></i></span>
                                <input type="number" name="rtnum_viajeros" id="rtnum_viajeros" class="form-control" required min="1">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">
                            <i class="fa-solid fa-xmark me-1"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-success shadow-sm">
                            <i class="fa-solid fa-check me-1"></i> Confirmar reserva
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
