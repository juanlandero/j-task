        <!-- Modal -->
        <div class="modal fade" id="modalNuevaTarea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p class="h4 mb-2 mt-2 text-center">Nueva Materia</p>
                        <form id="nueva-tarea" method="POST" @submit.prevent="newTask">
                            @csrf
                            <div data-test="card-body" class="card-body">
                                <div class="md-form md-outline">
                                    <input type="text" id="titulo" name="titulo" class="form-control">
                                    <label for="titulo">Titulo</label>
                                </div>
                                <div class="md-form md-outline" >
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="7" style="border-radius: 4px"></textarea>
                                    <label for="descripcion">Descripción</label>
                                </div>
                                <select class="browser-default custom-select" name="pk_materia" id="materia">
                                    <option disabled selected>Materia</option>
                                    @foreach ($materias as $materia)
                                        <option value="{{ $materia->pk_materia }}">{{ $materia->materia }}</option>                                        
                                    @endforeach
                                </select>
                                <div class="md-form md-outline">
                                    <input type="text" id="fecha" name="fecha" class="form-control">
                                    <label for="titulo">Fecha de entrega:  2020-01-01 14:00:00</label>
                                </div>
                                <button class="btn btn-info btn-block mt-3" type="submit">Crear</button>
                            </div>
                        </form>
                    </div>
                
                </div>
            </div>
        </div>