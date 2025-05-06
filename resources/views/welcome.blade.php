@extends('layouts.app')

@section('title', 'Bienvenido')

@section('content')
<div class="vh-100 d-flex align-items-center justify-content-center" style="background: url('{{ asset('images/welcome_transfer.webp') }}') no-repeat center center/cover;">
  <div class="bg-dark bg-opacity-75 p-5 rounded text-white text-center">
    <h1 class="display-4">Isla Transfers</h1>
    <p class="lead mb-4">Tu solución confiable para traslados aeropuerto-hotel</p>
    
    {{-- Asegúrate de tener estas rutas definidas --}}
    <a href="{{ route('login') }}" class="btn btn-primary btn-lg me-2">Iniciar sesión</a>
    <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">Registro</a>
  </div>
</div>
@endsection