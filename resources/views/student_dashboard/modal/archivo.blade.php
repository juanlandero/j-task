<!-- Modal -->
<div class="modal fade" id="modalArchivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <p class="h4 mb-2 mt-4 text-center">Entregar Tarea</p>

                <form id="uploadFile"  class="p-5" method="POST" @submit.prevent="newFile" action="{{ route('studen.task.save') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="pk_usuario" value="{{ Auth::user()->pk_usuario }}">
                    <input type="hidden" name="pk_tarea" v-model="upload_pk_tarea">
                    <div class="custom-file">
                        <input type="file" name="archivo" class="custom-file-input" id="customFileLang" value="" lang="es" @change="getImage">
                        <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
                      </div>
    
    
                    <button class="btn btn-info btn-block my-5" type="submit">Entregar</button>
     
                </form>
                <p class="h4 mb-2 mt-4 text-center">Archivos entregados</p>
                <ul class="list-group list-group-flush px-5">
                    <modal-source v-for="resource in modalResources" 
                        v-bind:key = "resource.pk_alumno_tarea_recurso"
                        :nombre = "resource.recurso"
                    ></modal-source>
                </ul>
            </div>
        
        </div>
    </div>
</div>