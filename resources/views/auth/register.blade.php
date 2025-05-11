@extends('layouts.app')

@section('title', 'Registro de Usuario')

@section('content')

<style>
  html, body {
    margin: 0;
    padding: 0;
    height: 100%;
    overflow-x: hidden;
  }

  .fullscreen-background {
    position: fixed;
    top: 0;
    left: 0;
    z-index: -1;
    width: 100vw;
    height: 100vh;
    background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                url('{{ asset('images/welcome_transfer.webp') }}') no-repeat center center;
    background-size: cover;
  }

  .glass-card {
    background-color: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    padding: 2.5rem;
    border-radius: 1rem;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
    color: white;
    width: 100%;
    max-width: 650px;
  }

  .form-label, .form-text {
    color: #f8f9fa;
  }
</style>

<div class="fullscreen-background"></div>

{{-- Ajustamos para que no se superponga con el navbar y permita scroll --}}
<div class="container py-5" style="margin-top: 80px; margin-bottom: 60px;">
  <div class="d-flex justify-content-center">
    <div class="glass-card">
      <form action="{{ route('register.submit') }}" method="POST">
        @csrf

        <div class="text-center mb-4">
          <img src="{{ asset('images/register.png') }}" alt="Imagen de registro" style="width: 80px; height: auto;">
          <h3 class="mt-3 fw-bold">Registro de nuevo usuario</h3>
        </div>

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

        <div class="row mb-4">
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
          <button type="submit" class="btn btn-success fw-bold">
            <i class="fas fa-user-plus me-2"></i> Registrar
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection
