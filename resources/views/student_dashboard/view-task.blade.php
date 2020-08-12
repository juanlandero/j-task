@extends('layouts.studentDashboard')

@section('pagina', 'Alumno - Tareas')

@section('Tares', 'Tareas')

@section('acciones-encabezado')
<div class="col-md-8 text-center">

</div>
@endsection

@section('contenido')

    <div class="row text-center" >
        <div class="col-lg-8 text-left">
            <div class="px-4 py-4" style="border-radius: 15px; background-color:white;">
                <h4>Titulo de la tarea</h4>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Accusantium, cupiditate dolore. Ut laborum quae aperiam eos, molestias id odio consequatur eveniet perspiciatis, sed reprehenderit at quam inventore, perferendis corporis officia?</p>
                <br>

                 <!--Section: Content-->
  <section class="p-5 z-depth-1">
    
    <h3 class="text-center font-weight-bold mb-5">Counter</h3>

    <div class="row d-flex justify-content-center">

      <div class="col-md-6 col-lg-3 mb-4 text-center">
        <h4 class="h1 font-weight-normal mb-3">
          <i class="fas fa-file-alt indigo-text"></i>
          <span class="d-inline-block count-up" data-from="0" data-to="100" data-time="2000">100</span>
        </h4>
        <p class="font-weight-normal text-muted">Unique Page</p>
      </div>

      <div class="col-md-6 col-lg-3 mb-4 text-center">
        <h4 class="h1 font-weight-normal mb-3">
          <i class="fas fa-layer-group indigo-text"></i>
          <span class="d-inline-block count1" data-from="0" data-to="250" data-time="2000">250</span>
        </h4>
        <p class="font-weight-normal text-muted">Block Variety</p>
      </div>

      <div class="col-md-6 col-lg-3 mb-4 text-center">
        <h4 class="h1 font-weight-normal mb-3">
          <i class="fas fa-pencil-ruler indigo-text"></i>
          <span class="d-inline-block count2" data-from="0" data-to="330" data-time="2000">330</span>
        </h4>
        <p class="font-weight-normal text-muted">Reusable Component</p>
      </div>
      
      <div class="col-md-6 col-lg-3 mb-4 text-center">
        <h4 class="h1 font-weight-normal mb-3">
          <i class="fab fa-react indigo-text"></i>
          <span class="d-inline-block count3" data-from="0" data-to="430" data-time="2000">430</span>
        </h4>
        <p class="font-weight-normal text-muted">Crafted Element</p>
      </div>

    </div>

  </section>

                <small>FECHA DE ENTREGA: 26-Sep-2020</small>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="px-4 py-4" style="border-radius: 15px; background-color:white;">

                <h4>Recursos</h4>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Accusantium, cupiditate dolore. Ut laborum quae aperiam eos, molestias id odio consequatur eveniet perspiciatis, sed reprehenderit at quam inventore, perferendis corporis officia?</p>
            </div>
        </div>

        <div class="col-lg-12 pt-3">
            <div class="px-4 py-4" style="border-radius: 15px; background-color:white;">

                <h4>Enviar Tarea</h4>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Accusantium, cupiditate dolore. Ut laborum quae aperiam eos, molestias id odio consequatur eveniet perspiciatis, sed reprehenderit at quam inventore, perferendis corporis officia?</p>
            </div>
        </div>
    </div>

@endsection
