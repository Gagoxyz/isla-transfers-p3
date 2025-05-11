@php
use Illuminate\Support\Str;
use App\Models\TransferHotel;
use App\Models\TransferVehiculo;
use App\Models\TransferViajero;

$newUUID = Str::upper(Str::random(7));
$emails = TransferViajero::pluck('email');
$hoteles = TransferHotel::all();
$vehiculos = TransferVehiculo::all();
@endphp

<div class="modal fade" id="roundTripAdminModal" tabindex="-1" aria-labelledby="customerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-success shadow rounded-4">
            <div class="modal-header bg-success text-white rounded-top-4">
                <h5 class="modal-title" id="customerModalLabel">
                    <i class="fa-solid fa-circle-plus me-2"></i> Nueva reserva (Ida-Vuelta)
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.reserva.roundtrip') }}" method="POST">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Localizador</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-barcode"></i></span>
                                <input type="text" value="{{ $newUUID }}" name="uuid" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email del cliente</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                <select class="form-select" name="customerEmailSelect" id="customerEmailSelect" required>
                                    <option selected disabled>Seleccionar...</option>
                                    @foreach($emails as $email)
                                    <option value="{{ $email }}">{{ $email }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <h6 class="mt-3 mb-2">Datos de llegada</h6>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Día de llegada</label>
                            <input type="date" name="bookingDate" id="bookingDate" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Hora de llegada</label>
                            <input type="time" name="bookingTime" id="bookingTime" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Número de vuelo</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-plane"></i></span>
                                <input type="text" name="flyNumer" id="flyNumer" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Aeropuerto de origen</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span>
                                <input type="text" name="originAirport" id="originAirport" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Hotel de destino</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-hotel"></i></span>
                            <select class="form-select" name="hotelSelect" id="hotelSelect" required>
                                <option selected disabled>Seleccionar...</option>
                                @foreach($hoteles as $hotel)
                                <option value="{{ $hotel->id_hotel }}">{{ $hotel->nombre_hotel }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <h6 class="mt-4 mb-2">Datos de salida</h6>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Día del vuelo</label>
                            <input type="date" name="dateFly" id="dateFly" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Hora del vuelo</label>
                            <input type="time" name="timeFly" id="timeFly" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Hora de recogida</label>
                            <input type="time" name="pickupTime" id="pickupTime" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Vehículo</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-car"></i></span>
                                <select class="form-select" name="carSelect" id="carSelect" required>
                                    <option selected disabled>Seleccionar...</option>
                                    @foreach($vehiculos as $vehiculo)
                                    <option value="{{ $vehiculo->id_vehiculo }}">{{ $vehiculo->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Número de pasajeros</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-users"></i></span>
                            <input type="number" name="passengerNum" id="passengerNum" class="form-control" required min="1">
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">
                            <i class="fa-solid fa-xmark me-1"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-success text-white shadow-sm">
                            <i class="fa-solid fa-check me-1"></i> Registrar reserva
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
