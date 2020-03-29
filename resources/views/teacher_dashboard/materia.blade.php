@extends('layouts.teacherDashboard')

@section('pagina', 'Materias - Dashboard')

@section('titulo', 'Materias')

@section('acciones-encabezado')
<div class="col-md-8 text-center">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalMateria">
        Nueva materia
    </button>
</div>
@endsection

@section('contenido')
    <div class="row mt-4" id="subjects">
        <card-materia v-for="materia in materias"
                    v-bind:key = "materia.pk_materia"
                    :materia = "materia.materia"
                    :docente = "materia.docente"
                    :grupo = "materia.grupo"
                    :grado = "materia.grado"
        ></card-materia>

        <!-- Modal -->
        <div class="modal fade" id="modalMateria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form id="nueva-materia" method="GET" @submit.prevent="newSubjects">
                            @csrf
                            <div data-test="card-body" class="card-body">
                                <div class="md-form md-outline">
                                    <input type="text" id="form1"v-model="nuevaMateria.nombre" class="form-control">
                                    <label for="form1">Materia</label>
                                </div>
                                <select class="browser-default custom-select" v-model=nuevaMateria.grupo> 
                                    <option disabled selected>Grupo</option>                                   
                                    @foreach ($grupos as $grupo)
                                        <option value="{{ $grupo->pk_grupo }}">{{ $grupo->grupo_nivel }} - {{ $grupo->grupo }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-info btn-block mt-3" type="submit">Crear</button>
                            </div>
                        </form>
                    </div>
                
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>

Vue.component('card-materia', {
    props: [
        'materia',
        'docente',
        'grupo',
        'grado',
    ],
    template: `
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><a>@{{ materia }}</a></h4>
                <p class="card-text">@{{ grupo }} - @{{ grado }}</p>
                <a href="#" class="btn btn-primary">@{{ docente }}</a>
            </div>
        </div>
    </div>
    `,
})

var appMateria = new Vue({
    delimiters: ['${', '}'],
    el: '#subjects',
    data: {
        materias: [],
        nuevaMateria: {
            nombre: null,
            grupo: null,
        }
    },
    mounted: function () {
        this.getSubjects()
    },
    methods: {

        getSubjects(){
            var _that = this

            axios.get('/teacher/subjects/get')
                .then(response => {
                    _that.materias = response.data.materia
                })
        },
        newSubjects(){
            var _that = this

            axios.get('/teacher/subjects/new', {
                    params: {
                        materia: _that.nuevaMateria.nombre,
                        pk_grupo: _that.nuevaMateria.grupo
                    }
                })
                .then(response => {
                    _that.getSubjects()
                })
        }
    }
})

</script>
@endsection