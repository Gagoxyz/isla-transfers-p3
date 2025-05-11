@php
use Illuminate\Support\Str;
$uuid = Str::random(7);
use App\Models\TransferVehiculo;
use App\Models\TransferViajero;
$emails = TransferViajero::pluck('email');
$vehiculos = TransferVehiculo::all();
@endphp

<div class="modal fade" id="hotelRoundTripModal" tabindex="-1" aria-labelledby="customerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content shadow-lg border-0 rounded-4">

      <!-- Header verde -->
      <div class="modal-header bg-success text-white rounded-top-4">
        <h5 class="modal-title" id="customerModalLabel">
          <i class="fa-solid fa-circle-plus me-2"></i> Nueva reserva ida y vuelta
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body p-4">
        <form action="{{ route('hotel.reserva.roundtrip') }}" method="POST">
          @csrf
          <div class="row g-4">

            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" value="{{ $uuid }}" name="rthotelUUID" id="rthotelUUID" class="form-control" readonly>
                <label for="rthotelUUID"><i class="fa-solid fa-barcode me-1"></i> Localizador</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <select class="form-select" name="rthotelCustomerEmail" id="rthotelCustomerEmail" required>
                  <option selected disabled>Seleccionar...</option>
                  @foreach($emails as $email)
                    <option value="{{ $email }}">{{ $email }}</option>
                  @endforeach
                </select>
                <label for="rthotelCustomerEmail"><i class="fa-solid fa-envelope me-1"></i> Email del cliente</label>
              </div>
            </div>

            <!-- IDA -->
            <div class="col-12">
              <strong><i class="fa-solid fa-plane-arrival me-1"></i> Datos de llegada (IDA)</strong>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="date" name="rthotel_fecha_entrada" id="rthotel_fecha_entrada" class="form-control" required>
                <label for="rthotel_fecha_entrada"><i class="fa-solid fa-calendar-day me-1"></i> Día de llegada</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="time" name="rthotel_hora_entrada" id="rthotel_hora_entrada" class="form-control" required>
                <label for="rthotel_hora_entrada"><i class="fa-solid fa-clock me-1"></i> Hora de llegada</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" name="rthotel_numero_vuelo_entrada" id="rthotel_numero_vuelo_entrada" class="form-control" required>
                <label for="rthotel_numero_vuelo_entrada"><i class="fa-solid fa-plane-arrival me-1"></i> Nº vuelo</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" name="rthotel_origen_vuelo_entrada" id="rthotel_origen_vuelo_entrada" class="form-control" required>
                <label for="rthotel_origen_vuelo_entrada"><i class="fa-solid fa-plane-departure me-1"></i> Origen</label>
              </div>
            </div>

            <!-- VUELTA -->
            <div class="col-12">
              <strong><i class="fa-solid fa-plane-departure me-1"></i> Datos de salida (VUELTA)</strong>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="date" name="rthotel_fecha_vuelo_salida" id="rthotel_fecha_vuelo_salida" class="form-control" required>
                <label for="rthotel_fecha_vuelo_salida"><i class="fa-solid fa-calendar-check me-1"></i> Día de salida</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="time" name="rthotel_hora_vuelo_salida" id="rthotel_hora_vuelo_salida" class="form-control" required>
                <label for="rthotel_hora_vuelo_salida"><i class="fa-solid fa-clock me-1"></i> Hora de salida</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="time" name="rthotel_hora_recogida_salida" id="rthotel_hora_recogida_salida" class="form-control" required>
                <label for="rthotel_hora_recogida_salida"><i class="fa-solid fa-van-shuttle me-1"></i> Hora de recogida</label>
              </div>
            </div>

            <!-- Vehículo y pasajeros -->
            <div class="col-md-6">
              <div class="form-floating">
                <select class="form-select" name="rthotel_vehiculo" id="rthotel_vehiculo" required>
                  <option selected disabled>Seleccionar...</option>
                  @foreach($vehiculos as $vehiculo)
                    <option value="{{ $vehiculo->id_vehiculo }}">{{ $vehiculo->descripcion }}</option>
                  @endforeach
                </select>
                <label for="rthotel_vehiculo"><i class="fa-solid fa-car-side me-1"></i> Vehículo</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="number" name="rthotel_num_viajeros" id="rthotel_num_viajeros" class="form-control" required min="1">
                <label for="rthotel_num_viajeros"><i class="fa-solid fa-user-group me-1"></i> Nº de pasajeros</label>
              </div>
            </div>

          </div>

          <!-- Footer -->
          <div class="modal-footer px-0 pt-4">
            <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">
              <i class="fa-solid fa-xmark me-1"></i> Cancelar
            </button>
            <button type="submit" class="btn btn-success">
              <i class="fa-solid fa-download me-1"></i> Registrar reserva
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
