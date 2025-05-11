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

<div class="modal fade" id="returnAdminModal" tabindex="-1" aria-labelledby="returnAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-danger shadow rounded-4">
            <div class="modal-header bg-danger text-white rounded-top-4">
                <h5 class="modal-title" id="returnAdminModalLabel">
                    <i class="fa-solid fa-circle-plus me-2"></i> Reserva Hotel → Aeropuerto
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.reserva.return') }}" method="POST">
                    @csrf
                    <input type="hidden" name="uuid" value="{{ $newUUID }}">

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
                                <select class="form-select" name="customerEmailSelect" id="customerEmailSelect">
                                    <option selected>Seleccionar...</option>
                                    @foreach($emails as $email)
                                    <option value="{{ $email }}">{{ $email }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

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
                            <label class="form-label">Hotel de recogida</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-hotel"></i></span>
                                <select class="form-select" name="hotelSelect" id="hotelSelect">
                                    <option selected>Seleccionar...</option>
                                    @foreach($hoteles as $hotel)
                                    <option value="{{ $hotel->id_hotel }}">{{ $hotel->nombre_hotel }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Vehículo</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-car"></i></span>
                                <select class="form-select" name="carSelect" id="carSelect">
                                    <option selected>Seleccionar...</option>
                                    @foreach($vehiculos as $vehiculo)
                                    <option value="{{ $vehiculo->id_vehiculo }}">{{ $vehiculo->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Número de pasajeros</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-users"></i></span>
                                <input type="number" name="passengerNum" id="passengerNum" class="form-control" required min="1">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">
                            <i class="fa-solid fa-xmark me-1"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-danger text-white shadow-sm">
                            <i class="fa-solid fa-check me-1"></i> Registrar reserva
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
