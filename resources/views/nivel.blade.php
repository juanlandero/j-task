<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Grado</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">

    <!-- Styles -->    
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
</head>
<body>

    <div class="container ">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-5">
                <form class="border border-light pt-5 pb-2 pl-5 pr-5 mt-3" method="POST" action="{{ route('set.grade') }}">
                    @csrf
                    <p class="h4 mb-5 text-center">Tu grado es</p>
              
                    
                    @for ($i = 0; $i < sizeof($niveles); $i++)
                        <p class="h5 text-center">{{ $niveles[$i]['nivel'] }}</p>

                        @foreach ($niveles[$i]['grupos'] as $grupo)
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="nivel" value="{{ $grupo['pk_grupo'] }}" id="{{ $grupo['pk_grupo'] }}">
                                <label class="custom-control-label" for="{{ $grupo['pk_grupo'] }}">{{ $grupo['grupo'] }}</label>
                            </div>
                        @endforeach
                    @endfor
    
                    <button class="btn btn-info btn-block my-5 mb-1" type="submit">Continuar</button>
                </form>
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
</body>
</html>
