<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Isla Transfers')</title>

    <!-- Estilos -->
    <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
<!-- <style>
    body {
        background-image: url('/images/background_transfer.webp');
        background-size: cover;
        background-attachment: fixed;
        background-repeat: no-repeat;
        background-position: center;
    }
    .glass-card {
        background-color: rgba(33, 37, 41, 0.75); /* bg-dark + opacity */
        border-radius: 1rem;
        padding: 2rem;
        color: white;
        box-shadow: 0 0 15px rgba(0,0,0,0.3);
    }

    .glass-btn {
        border-radius: 50px;
        padding: 0.75rem 1.5rem;
        font-weight: bold;
    }
</style> -->
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand">ISLA TRANSFERS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    {{-- Menú según tipo de sesión --}}
                    @if (session('id_admin'))
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.panel') }}">Panel de control</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Lista de reservas</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Gestión de hoteles</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Gestión de vehículos</a></li>
                    @elseif (session('id_viajero'))
                        <li class="nav-item"><a class="nav-link" href="{{ route('customer.panel') }}">Panel de control</a></li>
                    @elseif (session('id_hotel'))
                        <li class="nav-item"><a class="nav-link" href="{{ route('corp.panel') }}">Panel de control</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Lista de reservas</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('welcome') }}">Panel de control</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Registro</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    @endif

                    {{-- Mostrar dropdown de usuario si hay sesión --}}
                    @if (session('email'))
                        <li class="nav-item dropdown ms-auto">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                {{ session('email') }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Editar perfil</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="dropdown-item" type="submit">Cerrar sesión</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    {{-- Contenido --}}
    <div class="container mt-4">
        @yield('content')
    </div>

    {{-- Scripts de Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Scripts adicionales (como FullCalendar, etc.) --}}
    @stack('scripts')
</body>
</html>
 