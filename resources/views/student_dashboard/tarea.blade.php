@extends('layouts.studentDashboard')

@section('pagina', 'Alumno - Tareas')

@section('Tares', 'Tareas')

@section('acciones-encabezado')
<div class="col-md-8 text-center">
    <!-- Button trigger modal -->
   
</div>
@endsection

@section('contenido')
    <div class="row" id="task">
        {{-- <card-task v-for="tarea in tareas"
            v-bind:key = "tarea.pk_tarea"
            :materia = "tarea.materia"
            :status = "tarea.status"
            :tarea = "tarea.tarea"
            :detalle = "tarea.detalle"
            :entrega = "tarea.fecha_entrega"
        ></card-task> --}}


        <table class="table table-responsive-md btn-table" id="tablaTareas">

            <thead class="black white-text">
               
            </thead>
                        
        </table>
    </div>
@endsection

@section('js')
<script src="{{ asset('table/bootstrap-table.js') }}" ></script>

<script>

Vue.component('card-task', {
    props: [
        'materia',
        'status',
        'tarea',
        'detalle',
        'entrega',
    ],
    template: `

    <div class="col-md-4 mb-4">
        <div class="card border-dark" style="max-width: 20rem;">
            <div class="card-header">
                
        @{{ status }}
      
                </div>
            <div class="card-body text-dark">
                <h5 class="card-title">@{{ tarea }}</h5>
                <p class="card-text">@{{ detalle }}</p>
                <p class="card-text"><small class="text-muted">@{{ materia }}</small></p>
            </div>
        </div>
    </div>
    `,
})

var appTask = new Vue({
    delimiters: ['${', '}'],
    el: '#task',
    data: {
        tareas: [],
        nuevaMateria: {
            nombre: null,
            grupo: null,
        }
    },
    mounted: function () {
        this.getTask()
        this.loadTable()
    },
    methods: {

        getTask(){
            var _that = this

            axios.get('/student/task/get')
                .then(response => {
                    _that.tareas = response.data.tarea
                })
        },
        loadTable(){
            $('#tablaTareas').bootstrapTable({
                url: '/student/task/get',
                pagination: false,
                search: false,
                columns: [{
                    field: 'pk_tarea',
                    title: 'ID',
                }, {
                    field: 'materia',
                    title: 'MATERIA'
                }, {
                    field: 'tarea',
                    title: 'TAREA'
                }, {
                    field: 'detalle',
                    title: 'detalle'
                }, {
                    field: 'status',
                    title: 'STATUS'
                }, {
                    field: 'fecha_entrega',
                    title: 'ENTREGA'
                }, {
                    field: 'calificacion',
                    title: 'CALIFICACION'
                }, {
                    field: 'accion_entregar',
                    title: 'ENTREGAR'
                },]
            });
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