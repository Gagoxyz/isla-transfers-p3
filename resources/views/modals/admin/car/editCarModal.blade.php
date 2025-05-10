<!-- Modal de edición de vehículo -->
<div class="modal fade" id="editCarModal" tabindex="-1" aria-labelledby="editCarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-4">
            <form method="POST" id="editCarForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="id_vehiculo" id="editCarId">

                <div class="modal-header text-white rounded-top-4" style="background-color: #0056b3;">
                    <h5 class="modal-title fw-bold" id="editCarModalLabel">
                        <i class="fa-solid fa-pen-to-square me-2"></i> Editar vehículo
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" id="editCarDescription" name="descripcion" class="form-control" placeholder="Descripción del vehículo" required>
                                <label for="editCarDescription"><i class="fa-solid fa-car me-1"></i> Descripción del vehículo</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" name="email_conductor" id="editCarEmail" class="form-control" placeholder="Email del conductor" required>
                                <label for="editCarEmail"><i class="fa-solid fa-envelope me-1"></i> Email del conductor</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="password" name="password" id="editCarPassword" class="form-control" placeholder="Contraseña">
                                <label for="editCarPassword"><i class="fa-solid fa-lock me-1"></i> Nueva contraseña (opcional)</label>
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
