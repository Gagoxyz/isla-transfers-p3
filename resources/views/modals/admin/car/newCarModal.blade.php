<!-- Modal de registro de vehículo -->
<div class="modal fade" id="newCarModal" tabindex="-1" aria-labelledby="newCarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-4">
            <form action="{{ route('admin.vehiculos.store') }}" method="POST">
                @csrf
                <div class="modal-header text-white rounded-top-4" style="background-color: #0056b3;">
                    <h5 class="modal-title fw-bold" id="newCarModalLabel">
                        <i class="fa-solid fa-car-side me-2"></i> Registrar vehículo
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Descripción del vehículo" required>
                                <label for="descripcion"><i class="fa-solid fa-car me-1"></i> Descripción del vehículo</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" name="emailConductor" id="emailConductor" class="form-control" placeholder="Email del conductor" required>
                                <label for="emailConductor"><i class="fa-solid fa-envelope me-1"></i> Email del conductor</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <input type="password" name="conductorPassword" id="conductorPassword" class="form-control" placeholder="Contraseña" required>
                                <label for="conductorPassword"><i class="fa-solid fa-lock me-1"></i> Contraseña</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-between px-4 py-3">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark me-1"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-outline-primary shadow-sm">
                        <i class="fa-solid fa-cloud-arrow-up me-1"></i> Añadir vehículo
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
