@extends('layouts.app')

@section('title', 'Registro de Usuario')

@section('content')
<div class="container mt-5" style="max-width: 600px; padding: 20px; background: #fff; border-radius: 10px; box-shadow: 0px 8px 25px rgba(0, 0, 0, 0.2);">
    <form action="{{ route('register.submit') }}" method="POST">
        @csrf

        <div class="text-center mb-4">
            <img src="{{ asset('images/register.png') }}" alt="Imagen de registro" style="width: 80px; height: auto;">
            <h3 class="mt-3">Registro de nuevo usuario</h3>
        </div>

        {{-- Errores de validación --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" required>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="apellido1" class="form-label">Apellido 1</label>
                <input type="text" class="form-control" name="apellido1" value="{{ old('apellido1') }}" required>
            </div>
            <div class="col">
                <label for="apellido2" class="form-label">Apellido 2</label>
                <input type="text" class="form-control" name="apellido2" value="{{ old('apellido2') }}">
            </div>
        </div>

        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" name="direccion" value="{{ old('direccion') }}" required>
        </div>

        <div class="row mb-3">
            <div class="col-6">
                <label for="codigoPostal" class="form-label">Código Postal</label>
                <input type="text" class="form-control" name="codigoPostal" value="{{ old('codigoPostal') }}" required>
            </div>
            <div class="col-6">
                <label for="ciudad" class="form-label">Ciudad</label>
                <input type="text" class="form-control" name="ciudad" value="{{ old('ciudad') }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="pais" class="form-label">País</label>
            <input type="text" class="form-control" name="pais" value="{{ old('pais') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="row mb-3">
            <div class="col-6">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="col-6">
                <label for="password_confirmation" class="form-label">Repetir Contraseña</label>
                <input type="password" class="form-control" name="password_confirmation" required>
            </div>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-success">Registrar</button>
        </div>
    </form>
</div>
@endsection
