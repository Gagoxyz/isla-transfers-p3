@php
use Illuminate\Support\Str;
$uuid = Str::random(7);
use App\Models\TransferVehiculo;
use App\Models\TransferViajero;
$emails = TransferViajero::pluck('email');
$vehiculos = TransferVehiculo::all();
@endphp

<div class="modal fade" id="hotelReturnModal" tabindex="-1" aria-labelledby="customerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content shadow-lg border-0 rounded-4">

      <!-- Header rojo -->
      <div class="modal-header bg-danger text-white rounded-top-4">
        <h5 class="modal-title" id="customerModalLabel">
          <i class="fa-solid fa-circle-plus me-2"></i> Nueva reserva
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Cuerpo del modal -->
      <div class="modal-body p-4">
        <form action="{{ route('hotel.reserva.return') }}" method="POST">
          @csrf
          <div class="row g-4">

            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" value="{{ $uuid }}" name="rhotelUUID" id="rhotelUUID" class="form-control" readonly>
                <label for="rhotelUUID"><i class="fa-solid fa-barcode me-1"></i> Localizador</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <select class="form-select" name="rhotelCustomerEmail" id="rhotelCustomerEmail" required>
                  <option selected disabled>Seleccionar...</option>
                  @foreach($emails as $email)
                    <option value="{{ $email }}">{{ $email }}</option>
                  @endforeach
                </select>
                <label for="rhotelCustomerEmail"><i class="fa-solid fa-envelope me-1"></i> Email del cliente</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="date" name="rhotel_fecha_vuelo_salida" id="rhotel_fecha_vuelo_salida" class="form-control" required>
                <label for="rhotel_fecha_vuelo_salida"><i class="fa-solid fa-calendar-check me-1"></i> Día de salida</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="time" name="rhotel_hora_vuelo_salida" id="rhotel_hora_vuelo_salida" class="form-control" required>
                <label for="rhotel_hora_vuelo_salida"><i class="fa-solid fa-clock me-1"></i> Hora de salida</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="time" name="rhotel_hora_recogida_salida" id="rhotel_hora_recogida_salida" class="form-control" required>
                <label for="rhotel_hora_recogida_salida"><i class="fa-solid fa-van-shuttle me-1"></i> Hora de recogida</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <select class="form-select" name="rhotel_vehiculo" id="rhotel_vehiculo" required>
                  <option selected disabled>Seleccionar...</option>
                  @foreach($vehiculos as $vehiculo)
                    <option value="{{ $vehiculo->id_vehiculo }}">{{ $vehiculo->descripcion }}</option>
                  @endforeach
                </select>
                <label for="rhotel_vehiculo"><i class="fa-solid fa-car-side me-1"></i> Vehículo</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="number" name="rhotel_num_viajeros" id="rhotel_num_viajeros" class="form-control" required min="1">
                <label for="rhotel_num_viajeros"><i class="fa-solid fa-user-group me-1"></i> Nº de pasajeros</label>
              </div>
            </div>

          </div>

          <!-- Footer -->
          <div class="modal-footer px-0 pt-4">
            <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">
              <i class="fa-solid fa-xmark me-1"></i> Cancelar
            </button>
            <button type="submit" class="btn btn-danger">
              <i class="fa-solid fa-download me-1"></i> Registrar reserva
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
