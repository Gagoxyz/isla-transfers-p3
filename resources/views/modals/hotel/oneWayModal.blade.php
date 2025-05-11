@php
use Illuminate\Support\Str;
$uuid = Str::random(7);
use App\Models\TransferVehiculo;
use App\Models\TransferViajero;
$emails = TransferViajero::pluck('email');
$vehiculos = TransferVehiculo::all();
@endphp

<div class="modal fade" id="hotelOneWayModal" tabindex="-1" aria-labelledby="customerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content shadow-lg border-0 rounded-4">

      <!-- Header azul -->
      <div class="modal-header bg-primary text-white rounded-top-4">
        <h5 class="modal-title" id="customerModalLabel">
          <i class="fa-solid fa-circle-plus me-2"></i> Nueva reserva
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body p-4">
        <form action="{{ route('hotel.reserva.oneway') }}" method="POST">
          @csrf
          <div class="row g-4">

            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" value="{{ $uuid }}" name="hotelUUID" id="hotelUUID" class="form-control" readonly>
                <label for="hotelUUID"><i class="fa-solid fa-barcode me-1"></i> Localizador</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <select class="form-select" name="hotelCustomerEmail" id="hotelCustomerEmail" required>
                  <option selected disabled>Seleccionar...</option>
                  @foreach($emails as $email)
                    <option value="{{ $email }}">{{ $email }}</option>
                  @endforeach
                </select>
                <label for="hotelCustomerEmail"><i class="fa-solid fa-envelope me-1"></i> Email del cliente</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="date" name="hotel_fecha_entrada" id="hotel_fecha_entrada" class="form-control" required>
                <label for="hotel_fecha_entrada"><i class="fa-solid fa-calendar-day me-1"></i> Día de llegada</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="time" name="hotel_hora_entrada" id="hotel_hora_entrada" class="form-control" required>
                <label for="hotel_hora_entrada"><i class="fa-solid fa-clock me-1"></i> Hora de llegada</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" name="hotel_numero_vuelo_entrada" id="hotel_numero_vuelo_entrada" class="form-control" required>
                <label for="hotel_numero_vuelo_entrada"><i class="fa-solid fa-plane-arrival me-1"></i> Número de vuelo</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" name="hotel_origen_vuelo_entrada" id="hotel_origen_vuelo_entrada" class="form-control" required>
                <label for="hotel_origen_vuelo_entrada"><i class="fa-solid fa-plane-departure me-1"></i> Aeropuerto de origen</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <select class="form-select" name="hotel_vehiculo" id="hotel_vehiculo" required>
                  <option selected disabled>Seleccionar...</option>
                  @foreach($vehiculos as $vehiculo)
                    <option value="{{ $vehiculo->id_vehiculo }}">{{ $vehiculo->descripcion }}</option>
                  @endforeach
                </select>
                <label for="hotel_vehiculo"><i class="fa-solid fa-car-side me-1"></i> Vehículo</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="number" name="hotel_num_viajeros" id="hotel_num_viajeros" class="form-control" required min="1">
                <label for="hotel_num_viajeros"><i class="fa-solid fa-user-group me-1"></i> Nº de pasajeros</label>
              </div>
            </div>

          </div>

          <div class="modal-footer px-0 pt-4">
            <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">
              <i class="fa-solid fa-xmark me-1"></i> Cancelar
            </button>
            <button type="submit" class="btn btn-primary">
              <i class="fa-solid fa-download me-1"></i> Registrar reserva
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
