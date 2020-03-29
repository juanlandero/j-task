@extends('layouts.studentDashboard')

@section('pagina', 'Inicio - Dashboard')

@section('titulo', 'Inicio')

@section('acciones-encabezado')
<div class="col-md-8 text-center">
    <!-- Button trigger modal -->
   
</div>
@endsection

@section('contenido')
    <div class="row">
        <div class="col-md-10">

            <p class="h2">Bienvenido</p>
            <p>{{ $usuario }}</p>

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
    ],
    template: `
  
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