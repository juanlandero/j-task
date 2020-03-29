@extends('layouts.studentDashboard')

@section('pagina', 'Alumno - Tareas')

@section('Tares', 'Entregar Tareas')

@section('acciones-encabezado')
<div class="col-md-8 text-center">
    <!-- Button trigger modal -->
   
</div>
@endsection

@section('contenido')
    <div class="row">
        <div class="col-md-5">
            <form class="border border-light p-5" method="POST" action="{{ route('studen.task.save') }}" enctype="multipart/form-data">
                @csrf
                <p class="h4 mb-5 text-center">Subir archivo</p>
                <input type="hidden" name="pk_usuario" value="{{ $pk_usuario }}">
                <input type="hidden" name="pk_tarea" value="{{ $pk_tarea }}">
                <div class="custom-file">
                    <input type="file" name="archivo" class="custom-file-input" id="customFileLang" lang="es">
                    <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
                  </div>


                <button class="btn btn-info btn-block my-5" type="submit">Entregar</button>
            </form>
        </div>
    </div>

    <img src="{{ asset('storage/alumnos/1.jpeg') }}" alt="">

    <a href="{{ asset('images/') }}">link</a>

    @php
        echo  asset('images/file.txt');
    @endphp
@endsection

@section('js')

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
    },
    methods: {

        getTask(){
            var _that = this

            axios.get('/student/task/get')
                .then(response => {
                    _that.tareas = response.data.tarea
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