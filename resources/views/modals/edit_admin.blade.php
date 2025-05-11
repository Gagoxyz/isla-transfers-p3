<!-- Modal de edición de reserva -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow-lg border-0 rounded-4">

      <!-- Formulario de edición -->
      <form id="editReservationForm" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="reservaId" id="reservaId">
        <input type="hidden" name="tipoReserva" id="tipoReservaEdit">

        <div class="modal-header text-white rounded-top-4" style="background-color: #0056b3;">
          <h5 class="modal-title fw-bold" id="editModalLabel">
            <i class="fa-solid fa-pen-to-square me-2"></i> Editar reserva
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>

        <div class="modal-body p-4">
          <div class="row g-3">
            <!-- Localizador y Email -->
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" name="uuid" id="uuidEdit" class="form-control" placeholder="Localizador" readonly>
                <label for="uuidEdit"><i class="fa-solid fa-barcode me-1"></i> Localizador</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="email" name="customerEmailSelect" id="customerEmailEdit" class="form-control" placeholder="Email del cliente" required>
                <label for="customerEmailEdit"><i class="fa-solid fa-envelope me-1"></i> Email del cliente</label>
              </div>
            </div>

            <!-- Entrada -->
            <div class="campo-entrada col-md-6">
              <div class="form-floating">
                <input type="date" name="bookingDate" id="bookingDateEdit" class="form-control">
                <label for="bookingDateEdit"><i class="fa-solid fa-calendar-day me-1"></i> Fecha de entrada</label>
              </div>
            </div>

            <div class="campo-entrada col-md-6">
              <div class="form-floating">
                <input type="time" name="bookingTime" id="bookingTimeEdit" class="form-control">
                <label for="bookingTimeEdit"><i class="fa-solid fa-clock me-1"></i> Hora de entrada</label>
              </div>
            </div>

            <div class="campo-entrada col-md-6">
              <div class="form-floating">
                <input type="text" name="flyNumer" id="flyNumerEdit" class="form-control" placeholder="Nº vuelo">
                <label for="flyNumerEdit"><i class="fa-solid fa-plane-arrival me-1"></i> Número de vuelo</label>
              </div>
            </div>

            <div class="campo-entrada col-md-6">
              <div class="form-floating">
                <input type="text" name="originAirport" id="originAirportEdit" class="form-control" placeholder="Origen">
                <label for="originAirportEdit"><i class="fa-solid fa-plane-departure me-1"></i> Aeropuerto de origen</label>
              </div>
            </div>

            <!-- Salida -->
            <div class="campo-salida col-md-6">
              <div class="form-floating">
                <input type="date" name="dateFly" id="dateFlyEdit" class="form-control">
                <label for="dateFlyEdit"><i class="fa-solid fa-calendar-check me-1"></i> Fecha vuelo salida</label>
              </div>
            </div>

            <div class="campo-salida col-md-6">
              <div class="form-floating">
                <input type="time" name="timeFly" id="timeFlyEdit" class="form-control">
                <label for="timeFlyEdit"><i class="fa-solid fa-clock me-1"></i> Hora vuelo salida</label>
              </div>
            </div>

            <div class="campo-salida col-md-6">
              <div class="form-floating">
                <input type="time" name="pickupTime" id="pickupTimeEdit" class="form-control">
                <label for="pickupTimeEdit"><i class="fa-solid fa-van-shuttle me-1"></i> Hora de recogida</label>
              </div>
            </div>

            <div class="campo-salida col-md-6">
              <div class="form-floating">
                <input type="number" name="passengerNum" id="passengerNumEdit" class="form-control" min="1" placeholder="Nº pasajeros">
                <label for="passengerNumEdit"><i class="fa-solid fa-user-group me-1"></i> Nº pasajeros</label>
              </div>
            </div>

            <!-- Hotel y vehículo -->
            <div class="col-md-6">
              <div class="form-floating">
                <select name="hotelSelect" id="hotelSelectEdit" class="form-select">
                  @foreach(\App\Models\TransferHotel::all() as $hotel)
                    <option value="{{ $hotel->id_hotel }}">{{ $hotel->nombre_hotel }}</option>
                  @endforeach
                </select>
                <label for="hotelSelectEdit"><i class="fa-solid fa-hotel me-1"></i> Hotel</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <select name="carSelect" id="carSelectEdit" class="form-select">
                  @foreach(\App\Models\TransferVehiculo::all() as $vehiculo)
                    <option value="{{ $vehiculo->id_vehiculo }}">{{ $vehiculo->descripcion }}</option>
                  @endforeach
                </select>
                <label for="carSelectEdit"><i class="fa-solid fa-car-side me-1"></i> Vehículo</label>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer d-flex justify-content-between px-4 py-3">
          <!-- Eliminar -->
          <button type="button" class="btn btn-outline-danger shadow-sm" id="deleteReservationBtn">
            <i class="fa-solid fa-trash me-1"></i> Eliminar reserva
          </button>

          <!-- Cancelar / Guardar -->
          <div class="d-flex gap-2">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
              <i class="fa-solid fa-xmark me-1"></i> Cancelar
            </button>
            <button type="submit" class="btn btn-outline-primary shadow-sm">
              <i class="fa-solid fa-save me-1"></i> Guardar cambios
            </button>
          </div>
        </div>
      </form>

      <!-- Formulario de eliminación independiente -->
      <form id="deleteReservationForm" method="POST" class="d-none">
        @csrf
        @method('DELETE')
      </form>
    </div>
  </div>
</div>

<!-- Script de confirmación de eliminación -->
@push('scripts')
<script>
document.getElementById('deleteReservationBtn').addEventListener('click', function () {
    if (confirm('¿Seguro que quieres eliminar esta reserva?')) {
        document.getElementById('deleteReservationForm').submit();
    }
});
</script>
@endpush

@push('scripts')
<script>
document.getElementById('editReservationForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Evita que se recargue la página al enviar

    console.log("Datos enviados:");
    console.log({
        tipoReserva: document.getElementById('tipoReservaEdit').value,
        dateFly: document.getElementById('dateFlyEdit').value,
        timeFly: document.getElementById('timeFlyEdit').value,
        pickupTime: document.getElementById('pickupTimeEdit').value,
        bookingDate: document.getElementById('bookingDateEdit').value,
        bookingTime: document.getElementById('bookingTimeEdit').value
    });

    // Aquí puedes reactivar el envío manualmente si quieres continuar:
    this.submit();
});
</script>
@endpush

