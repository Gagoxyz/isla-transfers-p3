<div class="modal fade" id="editOneWayModal" tabindex="-1" aria-labelledby="editOneWayModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-primary shadow rounded-4">
            <div class="modal-header bg-primary text-white rounded-top-4">
                <h5 class="modal-title" id="editOneWayModalLabel">
                    <i class="fa-solid fa-plane-arrival me-2"></i> Editar reserva (Aeropuerto → Hotel)
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('booking.updateOneWay') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id_reserva" id="edit_id">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Localizador</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-barcode"></i></span>
                                <input type="text" class="form-control" id="edit_uuid" name="edit_uuid" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                <input type="email" class="form-control" id="edit_email_cliente" name="edit_email_cliente" value="{{ session('email') }}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Fecha llegada</label>
                            <input type="date" class="form-control" id="edit_fecha_entrada" name="edit_fecha_entrada" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Hora llegada</label>
                            <input type="time" class="form-control" id="edit_hora_entrada" name="edit_hora_entrada" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Número de vuelo</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-plane"></i></span>
                                <input type="text" class="form-control" id="edit_numero_vuelo_entrada" name="edit_numero_vuelo_entrada" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Origen del vuelo</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span>
                                <input type="text" class="form-control" id="edit_origen_vuelo_entrada" name="edit_origen_vuelo_entrada" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Hotel de destino</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-hotel"></i></span>
                                <select class="form-select" id="edit_id_hotel" name="edit_id_hotel" required>
                                    <option value="">Seleccionar...</option>
                                    @foreach ($hoteles as $hotel)
                                    <option value="{{ $hotel->id_hotel }}">{{ $hotel->nombre_hotel }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Vehículo</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-car"></i></span>
                                <select class="form-select" id="edit_id_vehiculo" name="edit_id_vehiculo" required>
                                    <option value="">Seleccionar...</option>
                                    @foreach ($vehiculos as $vehiculo)
                                    <option value="{{ $vehiculo->id_vehiculo }}">{{ $vehiculo->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Número de pasajeros</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-users"></i></span>
                            <input type="number" class="form-control" id="edit_num_viajeros" name="edit_num_viajeros" required min="1">
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">
                            <i class="fa-solid fa-xmark me-1"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary shadow-sm">
                            <i class="fa-solid fa-cloud-arrow-up me-1"></i> Guardar cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
