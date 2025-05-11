<div class="modal fade" id="editOneWayModal" tabindex="-1" aria-labelledby="editOneWayModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form method="POST" action="{{ route('hotel.update.oneway') }}">
      @csrf
      @method('PUT')
      <input type="hidden" name="id" id="edit-id-oneway">
      <div class="modal-content shadow-lg border-0 rounded-4">

        <!-- Header azul con icono -->
        <div class="modal-header text-white bg-primary rounded-top-4">
          <h5 class="modal-title" id="editOneWayModalLabel">
            <i class="fa-solid fa-pen-to-square me-2"></i> Editar Reserva Aeropuerto - Hotel
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>

        <!-- Cuerpo del modal -->
        <div class="modal-body p-4">
          <div class="row g-4">
            
            <div class="col-md-6">
              <div class="form-floating">
                <input type="email" class="form-control" name="email_cliente" id="edit-email-oneway" required readonly>
                <label for="edit-email-oneway"><i class="fa-solid fa-envelope me-1"></i> Email cliente</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" class="form-control" name="numero_vuelo_entrada" id="edit-vuelo-oneway" required>
                <label for="edit-vuelo-oneway"><i class="fa-solid fa-plane-arrival me-1"></i> Nº vuelo</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="date" class="form-control" name="fecha_entrada" id="edit-fecha-oneway" required>
                <label for="edit-fecha-oneway"><i class="fa-solid fa-calendar-day me-1"></i> Fecha llegada</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="time" class="form-control" name="hora_entrada" id="edit-hora-oneway" required>
                <label for="edit-hora-oneway"><i class="fa-solid fa-clock me-1"></i> Hora llegada</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" class="form-control" name="origen_vuelo_entrada" id="edit-origen-oneway" required>
                <label for="edit-origen-oneway"><i class="fa-solid fa-plane-departure me-1"></i> Origen vuelo</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="number" class="form-control" name="num_viajeros" id="edit-pasajeros-oneway" required min="1">
                <label for="edit-pasajeros-oneway"><i class="fa-solid fa-user-group me-1"></i> Pasajeros</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <select class="form-select" name="id_vehiculo" id="edit-vehiculo-oneway">
                  @foreach($vehiculos as $vehiculo)
                    <option value="{{ $vehiculo->id_vehiculo }}">{{ $vehiculo->descripcion }}</option>
                  @endforeach
                </select>
                <label for="edit-vehiculo-oneway"><i class="fa-solid fa-car-side me-1"></i> Vehículo</label>
              </div>
            </div>

          </div>
        </div>

        <!-- Footer del modal -->
        <div class="modal-footer px-4 py-3">
          <button type="submit" class="btn btn-primary">
            <i class="fa-solid fa-save me-1"></i> Guardar cambios
          </button>
        </div>

      </div>
    </form>
  </div>
</div>
