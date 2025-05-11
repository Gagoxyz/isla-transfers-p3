<div class="modal fade" id="editReturnModal" tabindex="-1" aria-labelledby="editReturnModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-danger shadow rounded-4">
            <div class="modal-header bg-danger text-white rounded-top-4">
                <h5 class="modal-title" id="editReturnModalLabel">
                    <i class="fa-solid fa-pen-to-square me-2"></i> Editar reserva (Hotel → Aeropuerto)
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('booking.updateReturn') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id_reserva" id="editReturn_id">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="editReturn_uuid" class="form-label">Localizador</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-barcode"></i></span>
                                <input type="text" class="form-control" id="editReturn_uuid" name="editReturn_uuid" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="editReturn_email_cliente" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                <input type="email" class="form-control" id="editReturn_email_cliente" name="editReturn_email_cliente" value="{{ session('email') }}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="editReturn_fecha_salida" class="form-label">Día salida</label>
                            <input type="date" class="form-control" id="editReturn_fecha_salida" name="editReturn_fecha_salida" required>
                        </div>
                        <div class="col-md-6">
                            <label for="editReturn_hora_salida" class="form-label">Hora salida</label>
                            <input type="time" class="form-control" id="editReturn_hora_salida" name="editReturn_hora_salida" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="editReturn_hora_recogida_salida" class="form-label">Hora recogida</label>
                            <input type="time" class="form-control" id="editReturn_hora_recogida_salida" name="editReturn_hora_recogida_salida" required>
                        </div>
                        <div class="col-md-6">
                            <label for="editReturn_id_hotel" class="form-label">Hotel</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-hotel"></i></span>
                                <select class="form-select" id="editReturn_id_hotel" name="editReturn_id_hotel" required>
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
                            <label for="editReturn_id_vehiculo" class="form-label">Vehículo</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-car"></i></span>
                                <select class="form-select" id="editReturn_id_vehiculo" name="editReturn_id_vehiculo" required>
                                    <option value="">Seleccionar...</option>
                                    @foreach ($vehiculos as $vehiculo)
                                    <option value="{{ $vehiculo->id_vehiculo }}">{{ $vehiculo->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="editReturn_num_viajeros" class="form-label">Número de pasajeros</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-users"></i></span>
                                <input type="number" name="editReturn_num_viajeros" id="editReturn_num_viajeros" class="form-control" required min="1">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">
                            <i class="fa-solid fa-xmark me-1"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-danger text-white shadow-sm">
                            <i class="fa-solid fa-cloud-arrow-up me-1"></i> Guardar cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
