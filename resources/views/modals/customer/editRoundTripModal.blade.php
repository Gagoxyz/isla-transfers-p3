<div class="modal fade" id="editRoundTripModal" tabindex="-1" aria-labelledby="editRoundTripModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-success shadow rounded-4">
            <div class="modal-header bg-success text-white rounded-top-4">
                <h5 class="modal-title" id="editRoundTripModalLabel">
                    <i class="fa-solid fa-pen-to-square me-2"></i> Editar reserva (Ida-Vuelta)
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('booking.updateRoundTrip') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id_reserva" id="editRoundTrip_id">

                    <h6 class="mb-3">Datos de entrada</h6>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Localizador</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-barcode"></i></span>
                                <input type="text" id="editRoundTrip_uuid" name="editRoundTrip_uuid" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                <input type="email" id="editRoundTrip_email_cliente" name="editRoundTrip_email_cliente" class="form-control" value="{{ session('email') }}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Día de llegada</label>
                            <input type="date" name="editRoundTrip_fecha_entrada" id="editRoundTrip_fecha_entrada" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Hora de llegada</label>
                            <input type="time" name="editRoundTrip_hora_entrada" id="editRoundTrip_hora_entrada" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Número de vuelo</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-plane"></i></span>
                                <input type="text" name="editRoundTrip_numero_vuelo_entrada" id="editRoundTrip_numero_vuelo_entrada" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Aeropuerto de origen</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span>
                                <input type="text" name="editRoundTrip_origen_vuelo_entrada" id="editRoundTrip_origen_vuelo_entrada" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Hotel de destino (ida)</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-hotel"></i></span>
                                <select class="form-select" name="editRoundTrip_id_hotel" id="editRoundTrip_id_hotel" required>
                                    <option value="">Seleccionar...</option>
                                    @foreach ($hoteles as $hotel)
                                    <option value="{{ $hotel->id_hotel }}">{{ $hotel->nombre_hotel }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <h6 class="mt-2 mb-3">Datos de salida</h6>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Día de salida</label>
                            <input type="date" name="editRoundTrip_fecha_vuelo_salida" id="editRoundTrip_fecha_vuelo_salida" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Hora de salida</label>
                            <input type="time" name="editRoundTrip_hora_vuelo_salida" id="editRoundTrip_hora_vuelo_salida" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Hora de recogida</label>
                            <input type="time" name="editRoundTrip_hora_recogida_salida" id="editRoundTrip_hora_recogida_salida" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Hotel de destino (vuelta)</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-hotel"></i></span>
                                <select class="form-select" name="editRoundTrip_tid_hotel" id="editRoundTrip_tid_hotel" required>
                                    <option value="">Seleccionar...</option>
                                    @foreach ($hoteles as $hotel)
                                    <option value="{{ $hotel->id_hotel }}">{{ $hotel->nombre_hotel }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Vehículo</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-car"></i></span>
                                <select class="form-select" name="editRoundTrip_id_vehiculo" id="editRoundTrip_id_vehiculo" required>
                                    <option value="">Seleccionar...</option>
                                    @foreach ($vehiculos as $vehiculo)
                                    <option value="{{ $vehiculo->id_vehiculo }}">{{ $vehiculo->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Número de pasajeros</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-users"></i></span>
                                <input type="number" name="editRoundTrip_num_viajeros" id="editRoundTrip_num_viajeros" class="form-control" required min="1">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">
                            <i class="fa-solid fa-xmark me-1"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-success text-white shadow-sm">
                            <i class="fa-solid fa-cloud-arrow-up me-1"></i> Guardar cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
