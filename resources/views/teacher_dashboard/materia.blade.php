@extends('layouts.teacherDashboard')

@section('pagina', 'Materias - Dashboard')

@section('titulo', 'Materias')

@section('contenido')

    <div class="row mt-2" id="subjects">
        <card-materia v-for="materia in materias"
                    v-bind:key = "materia.pk_materia"
                    :materia = "materia.materia"
                    :docente = "materia.docente"
                    :grupo = "materia.grupo"
                    :grado = "materia.grado"
        ></card-materia>

        <div class="fixed-action-btn">
            <a class="btn-floating btn-lg grey waves-effect waves-light" data-toggle="modal" data-target="#modalNuevaMateria">
                <i class="fas fa-plus"></i>
            </a>
        </div>
        @include('teacher_dashboard.modal.nueva-materia')
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
    <div class="col-md-3 mb-4">
        <div class="br br-body text-center">
            <h4 class="mb-3"><i class="fas fa-apple-alt"></i> @{{ materia }}</h4>
            <h5>@{{ grupo }}  @{{ grado }}</h5>
            <a href="#" class="btn btn-primary">@{{ docente }}</a>
        </div>
    </div>
    `,
})

var appMateria = new Vue({
    delimiters: ['${', '}'],
    el: '#subjects',
    data: {
        materias: [],
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
            var data = $('form#nueva-materia').serializeArray();
            
            axios.post('/teacher/subjects/new', {
                    nombre_materia: data[1].value,
                    pk_grupo: data[2].value,
                    color: data[3].value,
                })
                .then(response => {
                    _that.getSubjects()
                    _that.clearForm()
                })
        },
        clearForm(){
	        $("form#nueva-materia")[0].reset();
        }
    }
})

</script>
@endsection