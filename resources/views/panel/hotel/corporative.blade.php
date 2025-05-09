@extends('layouts.app')

@section('title', 'Bienvenido')

@include('modals.hotel.oneWayModal')

@section('content')
<div class="container py-3 mt-5">
    <h1 class="pb-5 row justify-content-center">Panel de administración CORPORATIVO</h1>
    <div class="row justify-content-center">
        <div class="col-auto">
            <button type="button" class="btn text-white fw-bold" style="background-color: #007bff;"
                data-bs-toggle="modal" data-bs-target="#hotelOneWayModal">
                <i class="fa-solid fa-circle-plus"></i> Reservar Aeropuerto-Hotel
            </button>
            <button type="button" class="btn text-white fw-bold" style="background-color: #dc3545;"
                data-bs-toggle="modal" data-bs-target="#returnAdminModal">
                <i class="fa-solid fa-circle-plus"></i> Reservar Hotel-Aeropuerto
            </button>
            <button type="button" class="btn text-white fw-bold" style="background-color: #28a745;"
                data-bs-toggle="modal" data-bs-target="#roundTripAdminModal">
                <i class="fa-solid fa-circle-plus"></i> Reservar ida-vuelta (Aeropuerto-Hotel/Hotel-Aeropuerto)
            </button>
        </div>
    </div>
    <hr>
</div>
@endsection