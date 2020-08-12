<!-- Modal -->
<div class="modal fade" id="modalListaAlumnos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body"><button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
                <p class="h4 mb-2 mt-4 text-center">Alumnos Registrados</p>
                
                <ul class="list-group list-group-flush px-5">
                    <list-alumno v-for="(student, index) in list" 
                        v-bind:key = "student.pk_alumno_grupo"
                        :numero = "index+1"
                        :nombre = "student.name"
                        :apellido1 = "student.first_name"
                        :apellido2 = "student.second_name"
                    ></list-alumno>
                </ul>
            </div>
        </div>
    </div>
</div>