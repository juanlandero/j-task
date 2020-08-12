@extends('layouts.studentDashboard')

@section('pagina', 'Alumno - Tareas')

@section('Tares', 'Tareas')

@section('acciones-encabezado')
<div class="col-md-8 text-center">
   
</div>
@endsection

@section('contenido')
    <div class="row" id="task">
        <div class="col-md-12">
            <div class="row text-center mb-md-3" style="color: #546e7a">
                <div class="col-md-5 col-lg-4  d-none d-md-block">
                    <small>TAREA</small>
                </div>
                <div class="col-md-3 col-lg-2  d-none d-md-block">
                    <small>MATERIA</small>
                </div>
                <div class="col-md-3 col-lg-2  d-none d-md-block">
                    <small>STATUS</small>
                </div>
                <div class="col-md-1 col-lg-1  d-none d-md-block">
                    <small>CAL</small>
                </div>
                <div class="col-lg-1  d-none d-lg-block">
                    <small>NOTAS</small>
                </div>
                <div class="col-lg-1  d-none d-lg-block">
                    <small>ENTREGAR</small>
                </div>
                <div class="col-lg-1  d-none d-lg-block">
                    <small>IR</small>
                </div>
            </div>

            <card-task v-for="tarea in tareas" @note="setNote(tarea.pk_tarea)" @file="setModalFile(tarea.pk_tarea, tarea.pk_alumno_tarea)"
                v-bind:key = "tarea.pk_tarea"
                :pk_materia = "tarea.pk_materia"
                :materia = "tarea.materia"
                :color = "tarea.color"
                :pk_tarea = "tarea.pk_tarea"
                :tarea = "tarea.tarea"
                :calificacion = "tarea.calificacion"
                :entrega = "tarea.fecha_entrega"
                :status = "tarea.status"
                :color_status = "tarea.color_status"
                :pk_alumno_tarea = "tarea.pk_alumno_tarea"
            ></card-task>
        </div>
        
            @include('student_dashboard.modal.notas')
            @include('student_dashboard.modal.archivo')
    </div>
@endsection

@section('js')

<script>

Vue.component('card-task', {
    props: [
        'pk_tarea',
        'pk_materia',
        'materia',
        'color',
        'tarea',
        'calificacion',
        'entrega',
        'status',
        'color_status',
    ],
    template: `
    <div class="row py-2 mb-3 align-items-center text-center br">     
    
        <div class="col-3 col-md-1 col-lg-1 mt-3 mt-sm-0" :style="{ color:color }">
            <i class="far fa-2x fa-folder"></i>
        </div>
        <div class="col-9 col-md-4 col-lg-3 mt-3 mt-sm-0 text-left">
            <p style="margin-bottom: 0px;">@{{ tarea }}</p>
            <small><i class="far fa-calendar-alt"></i> 30-Sep-20 <i class="far fa-clock"></i> 10:00</small>
        </div>
        <div class="col-12 col-md-3 col-lg-2 py-2">
            <p style="margin-bottom: 0px;">@{{ materia }}</p>
        </div>
        <div class="col-6 col-md-3 col-lg-2 py-1">
            <small :class="color_status"><i class="fas fa-circle"></i> @{{ status }}</small>
        </div>
        <div class="col-6 col-md-1 col-lg-1 py-1">
            <span>@{{ calificacion }}</span>
        </div>
        <div class="col-4 col-md-4 col-lg-1 pt-3 pb-2">
            <a data-toggle="modal" @click="$emit('note')" data-target="#modalNotas"><span class="grey-text"><i class="far fa-lg fa-sticky-note"></i></span></a>
        </div>
        <div class="col-4 col-md-4 col-lg-1 pt-3 pb-2">
            <a data-toggle="modal" @click="$emit('file')" data-target="#modalArchivo"><span class="grey-text"><i class="fas fa-lg fa-paperclip"></i></span></a>
        </div>
        <div class="col-4 col-md-4 col-lg-1 pt-3 pb-2">
            <a :href="'subject/' + pk_materia + '/task/' + pk_tarea"><span class="grey-text"><i class="fas fa-lg fa-chevron-circle-right"></i></span></a>
        </div>
    </div>
    `,
})

Vue.component('modal-source', {
    props: [
        'nombre'
    ],
    template: `
    <li class="list-group-item text-truncate"><i class="far fa-lg fa-file-image"></i> @{{ nombre }} </li>
    `,
})

var appTask = new Vue({
    delimiters: ['${', '}'],
    el: '#task',
    data: {
        tareas: [],
        notas: {
            pk_tarea: null,
            nota: null,
        },
        upload_pk_tarea: null,
        modalResources:null,
        modalFile: null,
    },
    mounted: function () {
        this.getTask()
    },
    methods: {

        getTask(){
            var _that = this

            axios.get('/student/task/get')
                .then(response => {
                    _that.tareas = response.data
                })
        },
        setNote(){
            console.log("prueba")
        },
        getImage(event){
            //Asignamos la imagen a  nuestra data
            this.modalFile = event.target.files[0];
        },
        setModalFile(pk_tarea, pk_alumno_tarea){
            _that = this
            this.upload_pk_tarea = pk_tarea

            //get resources
            axios.get('/student/task/get-resources', {
                    params: {
                        pk_alumno_tarea: pk_alumno_tarea
                    }
                })
                .then(response => {
                    _that.modalResources = response.data
                })

        },
        newFile(){
            var _that = this
            var data = $('form#uploadFile').serializeArray();

            var d = $('#customFileLang').val();
                //Añadimos la imagen seleccionada
            console.log(d);

            axios.post('task/submit/save', {
                    titulo: data[1].value,
                    detalle: data[2].value,
                    fecha: d
            })
            .then(response => {

            })
        }
   
    }
})

</script>
@endsection