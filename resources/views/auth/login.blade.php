@extends('layouts.app')

@section('title', 'Iniciar sesión')

@section('content')
<div class="vh-100 d-flex align-items-center justify-content-center">
  <div class="bg-dark bg-opacity-75 p-5 rounded text-white text-center" style="width: 100%; max-width: 400px;">
    <form method="POST" action="{{ route('login.submit') }}">
      @csrf

      @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
          <strong>Error:</strong> {{ $errors->first() }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <div class="mb-3 text-center">
        <img src="{{ asset('images/login.jpg') }}" alt="LoginImage" style="width: 100px; height: auto;">
        <h5 class="mt-2">Iniciar sesión</h5>
      </div>

      <div class="mb-3">
        <select name="user_type" class="form-select" required>
          <option value="1">Cliente</option>
          <option value="2">Hotel</option>
          <option value="3">Administrador</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="inputEmail" class="form-label">Identificador (email o ID)</label>
        <input type="email" name="inputEmail" class="form-control" required>
        <div id="infoEmail" class="form-text">Nunca compartiremos su correo electrónico con nadie más.</div>
      </div>

      <div class="mb-3">
        <label for="inputPassword" class="form-label">Contraseña</label>
        <input type="password" name="inputPassword" class="form-control" required>
      </div>

      <button type="submit" name="submitLogin" class="btn btn-primary w-100">Enviar</button>
    </form>
  </div>
</div>
@endsection
