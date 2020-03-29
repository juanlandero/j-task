<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('pagina')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">

    <!-- Styles -->    
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    @section('css')
    @show
</head>
<body>
    <div id="app">
        <!-- Navbar -->
        <nav class="mb-1 navbar z-depth-0" style="z-index: 10; border-bottom: 1px solid #f4f6f6; background-color: #fff;">
            <div class="container">
                <span class="navbar-brand">Docente</span>

                {{-- <button class="navbar-toggler" style="color: red" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
                    aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button> --}}
                
                <ul class="navbar-nav ml-auto nav-flex-icons">
                    {{-- <li class="nav-item">
                        <a class="nav-link waves-effect waves-light">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li> --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
                            <h6 class="dropdown-header">{{ Auth::user()->name }} {{ Auth::user()->first_name }} {{ Auth::user()->second_name }}</h6>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Cerrar sesión</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>

            </div>
        </nav>
        
        <!-- Sidebar -->
        <div class="container-side">
            <aside class="menu">
                <a class="aside-item active" title="Inicio">
                    <span class="icon is-large">
                        <i class="fas fa-lg fa-rocket"></i>
                    </span>                
                </a>

                <a class="aside-item" title="Grupos" href="{{ route('teacher.groups') }}">
                    <span class="icon is-large">
                        <i class="fas fa-lg fa-child"></i>
                    </span>                
                </a>
                
                <a class="aside-item" title="Materias" href="{{ route('teacher.subjects') }}">
                    <span class="icon is-large">
                        <i class="fas fa-lg fa-chalkboard-teacher"></i>
                    </span>                
                </a>

                <a class="aside-item" title="Tareas" href="{{ route('teacher.task') }}">
                    <span class="icon is-large">
                        <i class="fas fa-lg fa-book"></i>
                    </span>                
                </a>
            </aside>
        </div>

        <div class="container-dash">
    
            <div class="container">
                <div class="row">
                    <div class="col-md-11">
                        <div class="row">
                            <div class="col-md-4">
                                <p class="h4 blue-grey-text">@yield('titulo')</p>
                            </div>

                            @section('acciones-encabezado')
                                
                            @show
                        </div>

                        @section('contenido')
                        @show
                    </div>
                </div>
            </div>
        
        </div>
    </div>

    
    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}" ></script>
    <script src="{{ asset('js/axios.js') }}" ></script>
    <script src="{{ asset('js/vue.js') }}" ></script>
    <script src="{{ asset('js/popper.min.js') }}" ></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" ></script>
    <script src="{{ asset('js/mdb.min.js') }}" ></script>
    <script >
        $( document ).ready(function() {
            $('.dropdown-toggle').dropdown();
        });
    </script>

    @section('js')
    @show
</body>
</html>
