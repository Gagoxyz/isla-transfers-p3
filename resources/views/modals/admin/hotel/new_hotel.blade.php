<!-- Modal de nuevo hotel -->
<div class="modal fade" id="newHotelModal" tabindex="-1" aria-labelledby="newHotelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-4">
            <form action="{{ route('admin.hotel.store') }}" method="POST">
                @csrf
                <div class="modal-header text-white rounded-top-4" style="background-color: #0056b3;">
                    <h5 class="modal-title fw-bold" id="newHotelModalLabel">
                        <i class="fa-solid fa-square-h me-2"></i> Registrar nuevo hotel
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" id="hotelName" name="hotelName" class="form-control" placeholder="Nombre del hotel" required>
                                <label for="hotelName"><i class="fa-solid fa-hotel me-1"></i> Nombre del hotel</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" name="zoneSelect" id="zoneSelect" required>
                                    <option value="" disabled selected>Selecciona zona</option>
                                    @foreach(\App\Models\TransferZona::all() as $zona)
                                        <option value="{{ $zona->id_zona }}">{{ $zona->descripcion }}</option>
                                    @endforeach
                                </select>
                                <label for="zoneSelect"><i class="fa-solid fa-map-location-dot me-1"></i> Zona del hotel</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" name="hotelCommission" id="hotelCommission" class="form-control" step="0.01" min="0" max="100" placeholder="Comisión" required>
                                <label for="hotelCommission"><i class="fa-solid fa-percent me-1"></i> Comisión (%)</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" name="hotelEmail" id="hotelEmail" class="form-control" placeholder="Email del hotel" required>
                                <label for="hotelEmail"><i class="fa-solid fa-envelope me-1"></i> Email del hotel</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <input type="password" name="hotelPassword" id="hotelPassword" class="form-control" placeholder="Contraseña" required>
                                <label for="hotelPassword"><i class="fa-solid fa-lock me-1"></i> Contraseña</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-between px-4 py-3">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark me-1"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-outline-primary shadow-sm">
                        <i class="fa-solid fa-plus me-1"></i> Añadir hotel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
