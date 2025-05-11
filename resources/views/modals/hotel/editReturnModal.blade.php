<div class="modal fade" id="editReturnModal" tabindex="-1" aria-labelledby="editReturnModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form method="POST" action="{{ route('hotel.update.return') }}">
      @csrf
      @method('PUT')
      <input type="hidden" name="id" id="edit-id-return">
      <div class="modal-content shadow-lg border-0 rounded-4">

        <!-- Header rojo -->
        <div class="modal-header bg-danger text-white rounded-top-4">
          <h5 class="modal-title" id="editReturnModalLabel">
            <i class="fa-solid fa-pen-to-square me-2"></i> Editar Reserva Hotel - Aeropuerto
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>

        <!-- Cuerpo del modal -->
        <div class="modal-body p-4">
          <div class="row g-4">

            <div class="col-md-6">
              <div class="form-floating">
                <input type="email" class="form-control" name="email_cliente" id="edit-email-return" required readonly>
                <label for="edit-email-return"><i class="fa-solid fa-envelope me-1"></i> Email cliente</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="date" class="form-control" name="fecha_vuelo_salida" id="edit-fecha-salida-return" required>
                <label for="edit-fecha-salida-return"><i class="fa-solid fa-calendar-check me-1"></i> Fecha salida</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="time" class="form-control" name="hora_vuelo_salida" id="edit-hora-salida-return" required>
                <label for="edit-hora-salida-return"><i class="fa-solid fa-clock me-1"></i> Hora salida</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="time" class="form-control" name="hora_recogida_salida" id="edit-hora-recogida-return" required>
                <label for="edit-hora-recogida-return"><i class="fa-solid fa-van-shuttle me-1"></i> Hora recogida</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="number" class="form-control" name="num_viajeros" id="edit-pasajeros-return" required min="1">
                <label for="edit-pasajeros-return"><i class="fa-solid fa-user-group me-1"></i> Pasajeros</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <select class="form-select" name="id_vehiculo" id="edit-vehiculo-return">
                  @foreach($vehiculos as $vehiculo)
                    <option value="{{ $vehiculo->id_vehiculo }}">{{ $vehiculo->descripcion }}</option>
                  @endforeach
                </select>
                <label for="edit-vehiculo-return"><i class="fa-solid fa-car-side me-1"></i> Vehículo</label>
              </div>
            </div>

          </div>
        </div>

        <!-- Footer del modal -->
        <div class="modal-footer px-4 py-3">
          <button type="submit" class="btn btn-danger">
            <i class="fa-solid fa-save me-1"></i> Guardar cambios
          </button>
        </div>

      </div>
    </form>
  </div>
</div>
