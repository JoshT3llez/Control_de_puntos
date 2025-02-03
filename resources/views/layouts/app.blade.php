<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @stack('styles')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        body.light-mode {
            background-color: #f8f9fa;
            color: #212529;
        }
        body.dark-mode {
            background-color: #212529;
            color: #f8f9fa;
        }
        .navbar {
            background-color: inherit;
        }
        .navbar-brand, .nav-link, .dropdown-item {
            color: inherit;
        }
        .dropdown-menu {
            background-color: inherit;
            border: 1px solid #f8f9fa;
        }
        .dropdown-item:hover {
            background-color: #6c757d;
            color: #fff;
        }

        .nav-item .btn-outline-danger {
    display: flex;
    align-items: center;
    padding: 5px 10px;
    font-size: 14px;
}
    </style>
</head>
<body class="light-mode">
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/work_orders') }}">Bitácoras Pipas</a>
                <a class="navbar-brand" href="{{ url('/valvulas') }}">Válvulas</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item me-3">
                            <button id="toggle-dark-mode" class="btn btn-dark">
                                ☀️Claro
                            </button>
                        </li>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @else
                        <li class="nav-item d-flex align-items-center">
                            <span class="me-2">{{ Auth::user()->name }}</span> <!-- Nombre del usuario -->
                            <a class="btn btn-outline-danger btn-sm d-flex align-items-center" 
                               href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-1"></i> <!-- Icono de Bootstrap -->
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
    <script>
        const toggleButton = document.getElementById('toggle-dark-mode');
        const body = document.body;
        const currentMode = localStorage.getItem('theme') || 'light-mode';
        body.classList.add(currentMode);
    
        if (currentMode === 'dark-mode') {
            toggleButton.textContent = '☀️ Claro';
            toggleButton.classList.remove('btn-dark');
            toggleButton.classList.add('btn-light');
        }
    
        toggleButton.addEventListener('click', () => {
            if (body.classList.contains('dark-mode')) {
                body.classList.remove('dark-mode');
                body.classList.add('light-mode');
                toggleButton.textContent = '🌙 Oscuro';
                toggleButton.classList.remove('btn-light');
                toggleButton.classList.add('btn-dark');
                localStorage.setItem('theme', 'light-mode');
            } else {
                body.classList.remove('light-mode');
                body.classList.add('dark-mode');
                toggleButton.textContent = '☀️ Claro';
                toggleButton.classList.remove('btn-dark');
                toggleButton.classList.add('btn-light');
                localStorage.setItem('theme', 'dark-mode');
            }
        });
    </script>
    @stack('scripts')
</body>
</html>