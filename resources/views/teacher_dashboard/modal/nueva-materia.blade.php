<!-- Modal -->
<div class="modal fade" id="modalNuevaMateria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <p class="h4 mb-2 mt-4 text-center">Nueva Materia</p>
                <form id="nueva-materia" class="px-5" @submit.prevent="newSubjects">
                    @csrf
                    <div class="md-form md-outline">
                        <input type="text" id="form1" name="nombre_materia" class="form-control" autocomplete="off" required>
                        <label for="form1">Materia</label>
                    </div>
                    <select class="browser-default custom-select mb-4" name="pk_grupo" required> 
                        <option disabled selected>Grupo</option>                                   
                        @foreach ($grupos as $grupo)
                            <option value="{{ $grupo->pk_grupo }}">{{ $grupo->grupo_nivel }} - {{ $grupo->grupo }}</option>
                        @endforeach
                    </select>
                    
                    <input id="color-picker" class="form-control" name="color" value='#276cb8' required/>
                
                    <button class="btn btn-block btn-primary my-4" type="submit">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>