@extends('layouts.teacherDashboard')

@section('pagina', 'Grupos - Dashboard')

@section('titulo', 'Grupos')

@section('contenido')
    <div class="row mt-4" id="students">    
    @foreach ($grupos as $grupo)
        <div class="col-6 col-md-4 col-lg-3 mb-3">
            <div class="br br-body">
                <div class="row">
                    <div class="col-md-8 col-lg-8">
                        <h4>{{ $grupo->grupo }}</h4>
                        <small>{{ $grupo->grupo_nivel }}</small>
                    </div>
                    <div class="col-md-4 col-lg-4 text-center align-self-center">
                        <a href="#" @click="getStudents({{ $grupo->pk_grupo }})" data-toggle="modal" data-target="#modalListaAlumnos"><i class="fas fa-2x fa-chevron-circle-right"></i></a>
                    </div>
                </div>
            </div>

        </div>
    @endforeach

    @include('teacher_dashboard.modal.lista-alumno')
    </div>
@endsection

@section('js')

<script>
Vue.component('list-alumno', {
    props: [
        'numero',
        'nombre',
        'apellido1',
        'apellido2',
    ],
    template: `
        <li class="list-group-item text-truncate">@{{ numero }} - @{{ apellido1 }} @{{ apellido2 }} @{{ nombre }} </li>
    `,
})

var appListaAlumnos = new Vue({
    delimiters: ['${', '}'],
    el: '#students',
    data: {
        list: [],
    },
    methods: {

        getStudents(grupo){
            var _that = this

            axios.get('groups/get-students', {
                    params: {
                        pk_grupo: grupo
                    }
                })
                .then(response => {
                    _that.list = response.data
                })
        },
    }
})

</script>
@endsection