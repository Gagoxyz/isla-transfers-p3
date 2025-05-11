<div class="modal fade" id="editRoundTripModal" tabindex="-1" aria-labelledby="editRoundTripModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form method="POST" action="{{ route('hotel.update.roundtrip') }}">
      @csrf
      @method('PUT')
      <input type="hidden" name="id" id="edit-id-roundtrip">
      <div class="modal-content shadow-lg border-0 rounded-4">

        <!-- Header verde -->
        <div class="modal-header bg-success text-white rounded-top-4">
          <h5 class="modal-title" id="editRoundTripModalLabel">
            <i class="fa-solid fa-pen-to-square me-2"></i> Editar Reserva Ida-Vuelta
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>

        <!-- Cuerpo del modal -->
        <div class="modal-body p-4">
          <div class="row g-4">

            <!-- Email -->
            <div class="col-md-6">
              <div class="form-floating">
                <input type="email" class="form-control" name="email_cliente" id="edit-email-roundtrip" required readonly>
                <label for="edit-email-roundtrip"><i class="fa-solid fa-envelope me-1"></i> Email cliente</label>
              </div>
            </div>

            <!-- Sección IDA -->
            <div class="col-12">
              <strong><i class="fa-solid fa-plane-arrival me-1"></i> Datos de llegada (IDA)</strong>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" class="form-control" name="numero_vuelo_entrada" id="edit-vuelo-roundtrip" required>
                <label for="edit-vuelo-roundtrip"><i class="fa-solid fa-plane me-1"></i> Nº vuelo entrada</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="date" class="form-control" name="fecha_entrada" id="edit-fecha-entrada-roundtrip" required>
                <label for="edit-fecha-entrada-roundtrip"><i class="fa-solid fa-calendar-day me-1"></i> Fecha llegada</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="time" class="form-control" name="hora_entrada" id="edit-hora-entrada-roundtrip" required>
                <label for="edit-hora-entrada-roundtrip"><i class="fa-solid fa-clock me-1"></i> Hora llegada</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" class="form-control" name="origen_vuelo_entrada" id="edit-origen-roundtrip" required>
                <label for="edit-origen-roundtrip"><i class="fa-solid fa-plane-departure me-1"></i> Origen vuelo</label>
              </div>
            </div>

            <!-- Sección VUELTA -->
            <div class="col-12">
              <strong><i class="fa-solid fa-plane-departure me-1"></i> Datos de salida (VUELTA)</strong>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="date" class="form-control" name="fecha_vuelo_salida" id="edit-fecha-salida-roundtrip" required>
                <label for="edit-fecha-salida-roundtrip"><i class="fa-solid fa-calendar-check me-1"></i> Fecha salida</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="time" class="form-control" name="hora_vuelo_salida" id="edit-hora-salida-roundtrip" required>
                <label for="edit-hora-salida-roundtrip"><i class="fa-solid fa-clock me-1"></i> Hora salida</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="time" class="form-control" name="hora_recogida_salida" id="edit-hora-recogida-roundtrip" required>
                <label for="edit-hora-recogida-roundtrip"><i class="fa-solid fa-van-shuttle me-1"></i> Hora recogida</label>
              </div>
            </div>

            <!-- Pasajeros y vehículo -->
            <div class="col-md-6">
              <div class="form-floating">
                <input type="number" class="form-control" name="num_viajeros" id="edit-pasajeros-roundtrip" required min="1">
                <label for="edit-pasajeros-roundtrip"><i class="fa-solid fa-user-group me-1"></i> Pasajeros</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <select class="form-select" name="id_vehiculo" id="edit-vehiculo-roundtrip">
                  @foreach($vehiculos as $vehiculo)
                    <option value="{{ $vehiculo->id_vehiculo }}">{{ $vehiculo->descripcion }}</option>
                  @endforeach
                </select>
                <label for="edit-vehiculo-roundtrip"><i class="fa-solid fa-car-side me-1"></i> Vehículo</label>
              </div>
            </div>

          </div>
        </div>

        <!-- Footer -->
        <div class="modal-footer px-4 py-3">
          <button type="submit" class="btn btn-success">
            <i class="fa-solid fa-save me-1"></i> Guardar cambios
          </button>
        </div>

      </div>
    </form>
  </div>
</div>
