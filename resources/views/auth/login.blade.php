@extends('layouts.app')

@section('title', 'Iniciar sesión')

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
    max-width: 420px;
  }

  .form-label, .form-text {
    color: #f8f9fa;
  }
</style>

{{-- Fondo --}}
<div class="fullscreen-background"></div>

{{-- Contenido principal --}}
<div class="container py-5" style="margin-top: 80px; margin-bottom: 60px;">
  <div class="d-flex justify-content-center">
    <div class="glass-card">
      <form method="POST" action="{{ route('login.submit') }}">
        @csrf

        <div class="mb-4 text-center">
          <img src="{{ asset('images/login.jpg') }}" alt="LoginImage" style="width: 80px; height: auto;">
          <h3 class="mt-3 fw-bold">Iniciar sesión</h3>
        </div>

        @if ($errors->any())
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error:</strong> {{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <div class="mb-3">
          <label for="user_type" class="form-label">Tipo de usuario</label>
          <select name="user_type" class="form-select" required>
            <option value="1">Cliente</option>
            <option value="2">Hotel</option>
            <option value="3">Administrador</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="inputEmail" class="form-label">Identificador (email o ID)</label>
          <input type="email" name="inputEmail" class="form-control" required>
          <div class="form-text">Nunca compartiremos su correo electrónico con nadie más.</div>
        </div>

        <div class="mb-4">
          <label for="inputPassword" class="form-label">Contraseña</label>
          <input type="password" name="inputPassword" class="form-control" required>
        </div>

        <button type="submit" name="submitLogin" class="btn btn-primary w-100 fw-bold">
          <i class="fas fa-sign-in-alt me-2"></i> Entrar
        </button>
      </form>
    </div>
  </div>
</div>

@endsection
