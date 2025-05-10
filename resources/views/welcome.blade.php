@extends('layouts.app')

@section('title', 'Bienvenido')

@section('content')

<style>
  html, body {
    margin: 0;
    padding: 0;
    height: 100%;
    overflow: hidden;
  }

  .fullscreen-background {
    position: fixed;
    top: 0;
    left: 0;
    z-index: -1; /* ¡clave! */
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
    padding: 3rem;
    border-radius: 1rem;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
    text-align: center;
    color: white;
  }
</style>

{{-- Fondo independiente --}}
<div class="fullscreen-background"></div>

{{-- Contenido principal --}}
<div class="vh-100 d-flex align-items-center justify-content-center">
  <div class="glass-card">
    <h1 class="display-3 fw-bold">Isla Transfers</h1>
    <p class="fs-4 mb-4">Tu solución confiable para traslados aeropuerto-hotel</p>

    <div class="d-flex justify-content-center gap-3">
      <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 shadow">
        <i class="fas fa-sign-in-alt me-2"></i> Iniciar sesión
      </a>
      <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-4 shadow">
        <i class="fas fa-user-plus me-2"></i> Registro
      </a>
    </div>
  </div>
</div>

@endsection
