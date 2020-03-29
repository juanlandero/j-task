@extends('layouts.teacherDashboard')

@section('pagina', 'Tareas - Dashboard')

@section('titulo', 'Tareas')

@section('acciones-encabezado')
<div class="col-md-8 text-center">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTask">
        Nueva tarea
    </button>
</div>
@endsection

@section('contenido')
    <div class="row mt-4" id="task">
        <card-tarea v-for="tarea in tareas"
                    v-bind:key = "tarea.pk_tarea"
                    :materia = "tarea.materia"
                    :docente = "tarea.name"
                    :grupo = "tarea.grupo"
                    :tarea = "tarea.tarea_titulo"
                    :detalle = "tarea.tarea_detalle"
                    :fecha_entrega = "tarea.fecha_entrega"
        ></card-tarea>

        <!-- Modal -->
        <div class="modal fade" id="modalTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form id="nueva-tarea" method="GET" @submit.prevent="newTask">
                            @csrf
                            <div data-test="card-body" class="card-body">
                                <div class="md-form md-outline">
                                    <input type="text" id="titulo"v-model="nuevaTarea.titulo" class="form-control">
                                    <label for="titulo">Titulo</label>
                                </div>
                                <div class="md-form md-outline">
                                    <input type="text" id="descripcion"v-model="nuevaTarea.detalle" class="form-control">
                                    <label for="descripcion">Descripción</label>
                                </div>
                                <select class="browser-default custom-select" v-model="nuevaTarea.materia">
                                    <option disabled selected>Materia</option>
                                    @foreach ($materias as $materia)
                                        <option value="{{ $materia->pk_materia }}">{{ $materia->materia }}</option>                                        
                                    @endforeach
                                </select>
                                <div class="md-form md-outline">
                                    <input type="text" id="fecha"v-model="nuevaTarea.fecha" class="form-control">
                                    <label for="titulo">Fecha de entrega:  2020-01-01 14:00:00</label>
                                </div>
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

<script src="{{ asset('js/jquery.datetimepicker.js') }}" ></script>
<script>

$( document ).ready(function() {
  // Date Time Picker Initialization
  $('.date-time').dateTimePicker();
});
</script>

<script>
Vue.component('card-tarea', {
    props: [
        'materia',
        'docente',
        'grupo',
        'tarea',
        'detalle',
        'fecha_entrega',
    ],
    template: `
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card card-cascade">
            <div class="view view-cascade gradient-card-header blue-gradient">
                <h3 class="card-header-title mb-3">@{{ materia }}</h3>
                <p class="card-header-subtitle mb-0">@{{ tarea }}</p>
            </div>

            <div class="card-body card-body-cascade text-center">

                <p class="card-text">@{{ detalle }}</p>
                <hr>
                <p class="text-muted">@{{ grupo }} - Prof. @{{ docente }}</p>

            </div>

            <div class="card-footer text-muted text-center">Entrega: @{{ fecha_entrega }}</div>
        </div>
    </div>
    `,
})

var appTarea = new Vue({
    delimiters: ['${', '}'],
    el: '#task',
    data: {
        tareas: [],
        nuevaTarea: {
            materia: null,
            titulo: null,
            detalle: null,
            fecha: null,
        },
    },
    mounted: function () {
        this.getTask()
    },
    methods: {
        getTask(){
            var _that = this

            axios.get('/teacher/task/get')
                .then(response => {
                    _that.tareas = response.data.tareas
                })
        },
        newTask(){
            var _that = this

            axios.get('/teacher/task/new', {
                params: {
                    materia: _that.nuevaTarea.materia,
                    titulo: _that.nuevaTarea.titulo,
                    detalle: _that.nuevaTarea.detalle,
                    fecha: _that.nuevaTarea.fecha
                }
            })
            .then(response => {
                _that.getTask()
                _that.clearForm()
            })
        },
        clearForm(){
            this.nuevaTarea.materia = null
            this.nuevaTarea.titulo = null
            this.nuevaTarea.detalle = null
            this.nuevaTarea.fecha = null
        },
    }
})

</script>
@endsection