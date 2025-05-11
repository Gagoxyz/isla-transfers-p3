<!-- Modal de edición de hotel -->
<div class="modal fade" id="editHotelModal" tabindex="-1" aria-labelledby="editHotelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-4">
            <form method="POST" id="editHotelForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="id_hotel" id="editHotelId">
                
                <div class="modal-header text-white rounded-top-4" style="background-color: #0056b3;">
                    <h5 class="modal-title fw-bold" id="editHotelModalLabel">
                        <i class="fa-solid fa-pen-to-square me-2"></i> Editar hotel
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" id="editHotelName" name="hotelName" class="form-control" placeholder="Nombre del hotel" required>
                                <label for="editHotelName"><i class="fa-solid fa-hotel me-1"></i> Nombre del hotel</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <select name="zoneSelect" id="editHotelZona" class="form-select" required>
                                    <option value="" disabled selected>Selecciona zona</option>
                                    @foreach(\App\Models\TransferZona::all() as $zona)
                                        <option value="{{ $zona->id_zona }}">{{ $zona->descripcion }}</option>
                                    @endforeach
                                </select>
                                <label for="editHotelZona"><i class="fa-solid fa-map-location-dot me-1"></i> Zona del hotel</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" name="hotelCommission" id="editHotelCommission" class="form-control" step="0.01" min="0" max="100" placeholder="Comisión" required>
                                <label for="editHotelCommission"><i class="fa-solid fa-percent me-1"></i> Comisión (%)</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" name="hotelEmail" id="editHotelEmail" class="form-control" placeholder="Email del hotel" required>
                                <label for="editHotelEmail"><i class="fa-solid fa-envelope me-1"></i> Email del hotel</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <input type="password" name="hotelPassword" id="editHotelPassword" class="form-control" placeholder="Contraseña">
                                <label for="editHotelPassword"><i class="fa-solid fa-lock me-1"></i> Nueva contraseña (opcional)</label>
                            </div>
                            <small class="text-muted ms-1">Déjalo vacío si no deseas modificarla</small>
                        </div>
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-between px-4 py-3">
                    <button type="submit" class="btn btn-outline-primary shadow-sm">
                        <i class="fa-solid fa-save me-1"></i> Guardar cambios
                    </button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark me-1"></i> Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
