@extends('layouts.app')

@section('title', 'Gestión hoteles')

@section('content')
<div class="container py-4 mt-4">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
        <i class="fa-solid fa-triangle-exclamation me-2"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
    @endif

    <h2 class="text-center fw-bold mb-2" style="color: #0056b3;">
        <i class="fa-solid fa-hotel me-2"></i> Lista de hoteles registrados
    </h2>
    <p class="text-center text-muted fs-5 mb-4">Consulta y gestiona los hoteles</p>

    <div class="d-flex justify-content-end mb-3">
        <button type="button" class="btn fw-bold shadow-sm d-flex align-items-center"
            style="background-color: #0056b3; color: white;"
            data-bs-toggle="modal" data-bs-target="#newHotelModal">
            <i class="fa-solid fa-square-h me-2"></i> Añadir hotel
        </button>
    </div>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-dark border-bottom">
                        <tr>
                            <th>Nombre del hotel</th>
                            <th>Zona del hotel</th>
                            <th>Comisión</th>
                            <th>Email</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hoteles as $hotel)
                        <tr>
                            <td class="fw-semibold">{{ $hotel->nombre_hotel }}</td>
                            <td>{{ optional($hotel->zona)->descripcion ?? 'Zona no asignada' }}</td>
                            <td>{{ $hotel->comision }}%</td>
                            <td>{{ $hotel->email_hotel }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <button type="button" class="btn btn-sm btn-outline-primary shadow-sm editHotelBtn"
                                        title="Editar"
                                        data-id="{{ $hotel->id_hotel }}"
                                        data-nombre="{{ $hotel->nombre_hotel }}"
                                        data-comision="{{ $hotel->comision }}"
                                        data-email="{{ $hotel->email_hotel }}"
                                        data-zona="{{ $hotel->id_zona }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>

                                    <form action="{{ route('admin.hotel.destroy', $hotel->id_hotel) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger shadow-sm" title="Eliminar"
                                            onclick="return confirm('¿Eliminar este hotel?')">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('modals.admin.hotel.edit_hotel')
@include('modals.admin.hotel.new_hotel')
@endsection

@push('scripts')
<script>
    const BASE_URL = "{{ url('/') }}";
    document.querySelectorAll('.editHotelBtn').forEach(button => {
        button.addEventListener('click', () => {
            const id = button.dataset.id;
            document.getElementById('editHotelId').value = id;
            document.getElementById('editHotelForm').action = `${BASE_URL}/admin/hotel/${id}`;
            document.getElementById('editHotelName').value = button.dataset.nombre;
            document.getElementById('editHotelCommission').value = button.dataset.comision;
            document.getElementById('editHotelEmail').value = button.dataset.email;
            document.getElementById('editHotelZona').value = button.dataset.zona;
            document.getElementById('editHotelPassword').value = button.dataset.password;
            const modal = new bootstrap.Modal(document.getElementById('editHotelModal'));
            modal.show();
        });
    });
</script>
@endpush