@extends('layouts.teacherDashboard')

@section('pagina', 'Tareas - Dashboard')

@section('titulo', 'Tareas')

@section('contenido')
    <div class="row mt-4" id="task">
        <card-tarea v-for="tarea in tareas"
                    v-bind:key = "tarea.pk_tarea"
                    :pk_tarea = "tarea.pk_tarea"
                    :materia = "tarea.materia"
                    :materia_color = "tarea.color"
                    :docente = "tarea.name"
                    :grupo = "tarea.grupo"
                    :tarea = "tarea.tarea_titulo"
                    :detalle = "tarea.tarea_detalle"
                    :fecha_entrega = "tarea.fecha_entrega"
        ></card-tarea>

        <div class="fixed-action-btn">
            <a class="btn-floating btn-lg grey waves-effect waves-light" data-toggle="modal" data-target="#modalNuevaTarea">
                <i class="fas fa-plus"></i>
            </a>
        </div>

        @include('teacher_dashboard.modal.nueva-tarea')
    </div>
@endsection

@section('js')
<script src="{{ asset('js/jquery.datetimepicker.js') }}" ></script>

<script>
Vue.component('card-tarea', {
    props: [
        'pk_tarea',
        'materia',
        'materia_color',
        'docente',
        'grupo',
        'tarea',
        'detalle',
        'fecha_entrega',
    ],
    template: `
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="br br-body">
            <div class="row align-items-center">
                <div class="col-4">
                    <i class="fas fa-apple-alt fa-lg z-depth-1 p-4 text-white" :style="'background-color:' + materia_color" style="border-radius: 20%"></i>
                </div>
                <div class="col-8 text-right">
                    <p class="text-uppercase text-muted mb-1"><small>@{{ materia }} - @{{ grupo }}</small></p>
                    <p class="font-weight-bold mb-0">@{{ tarea }}</p>
                </div>
            </div>
            <div class="row text-center pt-4">
                <div class="col-12 px-4">
                    <p class="text-truncate text-center">@{{ detalle }}</p>
                </div>
            </div>
            <div class="progress md-progress" style="height: 20px">
                <div class="progress-bar bg-success" role="progressbar" style="width: 80%; height: 20px" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Entregas 25%</div>
            </div>
            <div class="row text-center pt-4">
                <div class="col-4"><a href="#"><i class="far fa-lg fa-grin-alt"></i></a></div>
                <div class="col-4"><a href="#"><i class="fas fa-lg fa-archive"></i></a></div>
                <div class="col-4"><a :href="'subject-task/get/' + pk_tarea" target="_blank" ><i class="fas fa-lg fa-file-signature"></i></a></div>
            </div>           
        </div>
    </div> 
    `,
})

var appTarea = new Vue({
    delimiters: ['${', '}'],
    el: '#task',
    data: {
        tareas: [],
    },
    mounted: function () {
        this.getTask()
    },
    methods: {
        getTask(){
            var _that = this
            var data = $('form#nueva-materia').serializeArray();

            axios.get('/teacher/task/get')
                .then(response => {
                    _that.tareas = response.data.tareas
                })
        },
        newTask(){
            var _that = this
            var data = $('form#nueva-tarea').serializeArray();

            axios.post('/teacher/task/new', {
                    titulo: data[1].value,
                    detalle: data[2].value,
                    materia: data[3].value,
                    fecha: data[4].value
            })
            .then(response => {
                _that.getTask()
                _that.clearForm()
            })
        },
        clearForm(){
	        $("form#nueva-tarea")[0].reset();
        },
        reviewTask(pk_tarea){

            var url = 'subject-task/get/' + pk_tarea
            window.open(url, "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=600, height=400");
        }
    }
})

</script>
@endsection