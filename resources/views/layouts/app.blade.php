<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@hasSection('title') @yield('title') | @endif {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
</head>
<body>
    <div id="app" class="d-flex flex-column min-vh-100">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                @auth()
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                @endauth()
                @guest
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                @endguest()
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
					@auth()
                    <ul class="navbar-nav mr-auto">
						<!--Nav Bar Hooks - Do not delete!!-->
						<li class="nav-item">
                            <a href="{{ url('/estudiantes') }}" class="nav-link"><i class="bi-house text-info"></i> Estudiantes</a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/cursos') }}" class="nav-link"><i class="bi-journal-bookmark-fill text-info"></i> Cursos</a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/instructors') }}" class="nav-link"><i class="bi-person-badge-fill text-info"></i> Instructores</a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/vehiculos') }}" class="nav-link"><i class="bi-car-front-fill text-info"></i> Vehículos</a> 
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownEstados" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi-list-check text-info"></i> Estados
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownEstados">
                                <li><a class="dropdown-item" href="{{ url('/estadolicenciainstructors') }}">Estado licencia instructores</a></li>
                                <li><a class="dropdown-item" href="{{ url('/estadomantenimientos') }}">Estado mantenimientos</a></li>
                                <li><a class="dropdown-item" href="{{ url('/estadovehiculos') }}">Estado vehiculos</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownConfig" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi-gear-fill text-info"></i> Configuración
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownConfig">
                                <li><a class="dropdown-item" href="{{ url('/users') }}">Usuarios</a></li>
                                <li><a class="dropdown-item" href="{{ url('/permisos') }}">Permisos</a></li>
                                <li><a class="dropdown-item" href="{{ url('/modulos') }}">Modulos</a></li>
                                <li><a class="dropdown-item" href="{{ url('/rols') }}">Roles</a></li>
                                <li><a class="dropdown-item" href="{{ url('/tenants') }}">Clientes</a></li>
                            </ul>
                        </li>
                    </ul>
					@endauth()

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->nombres }} {{ Auth::user()->apellidos }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 flex-grow-1">
            @yield('content')
        </main>
        
        <footer class="footer mt-auto py-3 bg-light text-center border-top">
            <div class="container">
                <span class="text-muted small"><b>CEA Web</b> con la tecnología de <a href="https://edgasanc.com" target="_blank" class="text-decoration-none fw-bold text-muted">EDGASANC.COM</a><br>Derechos Reservados {{ date('Y') }}</span>
            </div>
        </footer>
    </div>
    <script type="module">
        window.addEventListener('closeModal', () => {
            bootstrap.Modal.getInstance(document.getElementById('DataModal')).hide();
        })
    </script>
    @stack('scripts')
</body>
</html>