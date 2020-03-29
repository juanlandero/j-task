@extends('layouts.teacherDashboard')

@section('pagina', 'Grupos - Dashboard')

@section('titulo', 'Grupos')

@section('contenido')
    <div class="row mt-4">    
    @foreach ($grupos as $grupo)
            <div class="col-md-3 mb-3">
                
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><a>{{ $grupo->grupo }}</a></h4>
                        <p class="card-text">{{ $grupo->grupo_nivel }}</p>
                        <a href="#" class="btn btn-primary">Ver alumnos</a>
                    </div>
                </div>

            </div>
        @endforeach
    </div>
@endsection