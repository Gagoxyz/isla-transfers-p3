@extends('layouts.app')

@section('title', 'Comisiones del mes')

@section('content')
<div class="container py-4 mt-4">
    <h2 class="text-center fw-bold mb-2" style="color: #0056b3;">
        <i class="fa-solid fa-euro-sign me-2"></i> Comisiones del mes de {{ $mes }}
    </h2>
    <p class="text-center text-muted fs-5 mb-4">Detalle de las comisiones generadas por tus reservas</p>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            @if($reservas->isEmpty())
            <div class="alert alert-info mb-0" role="alert">
                <i class="fa-solid fa-info-circle me-2"></i> No hay reservas registradas este mes.
            </div>
            @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-dark border-bottom">
                        <tr>
                            <th>Localizador</th>
                            <th>Cliente</th>
                            <th>Fecha</th>
                            <th>Vehículo</th>
                            <th class="text-end">Precio</th>
                            <th class="text-end">Comisión</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservas as $reserva)
                        <tr>
                            <td class="fw-semibold">{{ $reserva->localizador }}</td>
                            <td>{{ $reserva->email_cliente }}</td>
                            <td>{{ \Carbon\Carbon::parse($reserva->fecha_reserva)->format('d/m/Y H:i') }}</td>
                            <td>{{ $reserva->vehiculo->descripcion }}</td>
                            <td class="text-end">{{ number_format($reserva->precio, 2) }} €</td>
                            <td class="text-end fw-bold text-success">{{ number_format($reserva->comision_hotel, 2) }} €</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <th colspan="5" class="text-end">Total comisión del mes:</th>
                            <th class="text-end text-success fw-bold">{{ number_format($totalComision, 2) }} €</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
