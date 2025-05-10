@extends('layouts.app')

@section('title', 'Gestión vehículos')

@section('content')
<div class="container py-4 mt-4">
    <h2 class="text-center fw-bold mb-2" style="color: #0056b3;">
        <i class="fa-solid fa-car me-2"></i> Lista de vehículos registrados
    </h2>
    <p class="text-center text-muted fs-5 mb-4">Gestiona fácilmente la flota de vehículos y sus conductores</p>

    <div class="d-flex justify-content-end mb-3">
        <button type="button" class="btn fw-bold shadow-sm d-flex align-items-center"
                style="background-color: #0056b3; color: white;"
                data-bs-toggle="modal" data-bs-target="#newCarModal">
            <i class="fa-solid fa-car-side me-2"></i> Añadir vehículo
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="fa-solid fa-triangle-exclamation me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-dark border-bottom">
                        <tr>
                            <th>Descripción del vehículo</th>
                            <th>Email del conductor</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vehiculos as $vehiculo)
                        <tr>
                            <td class="fw-semibold">{{ $vehiculo->descripcion }}</td>
                            <td>{{ $vehiculo->email_conductor }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <button type="button"
                                        class="btn btn-sm btn-outline-primary shadow-sm editCarBtn"
                                        title="Editar"
                                        data-id="{{ $vehiculo->id_vehiculo }}"
                                        data-descripcion="{{ $vehiculo->descripcion }}"
                                        data-email_conductor="{{ $vehiculo->email_conductor }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>

                                    <form action="{{ route('admin.vehiculos.destroy', $vehiculo->id_vehiculo) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger shadow-sm" title="Eliminar"
                                            onclick="return confirm('¿Eliminar el vehículo?')">
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

@include('modals.admin.car.editCarModal')
@include('modals.admin.car.newCarModal')
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.editCarBtn').forEach(button => {
        button.addEventListener('click', () => {
            const id = button.dataset.id;
            document.getElementById('editCarId').value = id;
            document.getElementById('editCarForm').action = `/admin/vehiculo/${id}`;
            document.getElementById('editCarDescription').value = button.dataset.descripcion;
            document.getElementById('editCarEmail').value = button.dataset.email_conductor;
            document.getElementById('editCarPassword').value = button.dataset.password;

            const modal = new bootstrap.Modal(document.getElementById('editCarModal'));
            modal.show();
        });
    });
</script>
@endpush
