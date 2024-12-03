<div>
    <div class='row'>
        <div class="col-md-4">
            <label for="nombre_g">Search name</label>
            <input type="text" wire:model='nombreFilter' class="form-control" name="nombre_g" id="nombre_g">
        </div>
        @if(Auth::user()->is_admin == true)
        <div class="col-md-4">
            <br>
            <a href="{{route('player.json')}}"><button type="button" class="btn btn-primary">Generar JSON</button></a>
        </div>
        @endif
    </div>

    @php
        $hoy = getdate();
        $fecha = $hoy['year'] . '-' . $hoy['mon'] . '-' . $hoy['mday'];
        $fechaHoy = new DateTime($fecha);
    @endphp

    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">GameTag</th>
            <th class='text-center' scope="col">Details</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($gimnastas as $gim)
                <tr>
                    <td>{{$gim->nombre_g}}</td>
                    <td>{{$gim->gametag}}</td>
                    <td class='text-center'>
                        <a href="/player/{{$gim->id}}">
                             <i class="bi bi-info-circle-fill"></i>
                        </a>
                    </td>  
                </tr>
            @endforeach
            @if(Auth::user()->is_admin == true)
              <tr>
                  <td><a href="{{route('player.create')}}">
                      <i class="bi bi-person-plus-fill"></i>
                      <span>Add player</span>
                  </a></td>
              </tr>
            @endif
        </tbody>
      </table>
      
      {{$gimnastas->links()}}


      <x-dialog-modal wire:model='display'>
        <x-slot name='title'>
          <div class="row text-center">
            <h1>Guía rapida de la interfaz de Gymicetics</h1>
          </div>
        </x-slot>
        <x-slot name='content'>
          <div class='row'>
            A continuación se muestra una breve guía sobre como utilizar nuestro sitio
          </div>
          <br>
          <div class="row">
            Las columnas superiores tienen como finalidad filtrar los registros mostrados:
          </div>
          <div class="row">
            <div class="col-lg-6">
              <label for="nameFilter" class="d-inline-block">Filtro de texto</label>
              <input type="text" placeholder="Nombre a buscar" name="nameFilter" id="nameFilter" class="form-control">
            </div>
            <div class="col-lg-6">
              <label for="confirmedFilter">Filtro de selección</label>
              <select name="confirmedFilter" id="confirmedFilter" class="form-control">
                <option value="">--Selecciona</option>
                <option value="1">Opción 1</option>
                <option value="false">Opción 2</option>
                <option value="false">Opción n</option>
              </select>
            </div>
          </div>
          <br>
          <div class="row">
            Esto limitará los resultados mostrados a los criterios señalados.
          </div> <br>
          <div class="row text-center">
            <h1>Botones</h1>
          </div>
          <br>
          <div class="row align-items-center">
            <div class="col-1">
              <button class="btn btn-success">+</button>
            </div>
            <div class='col-5'>Agregar registro</div>
  
            <div class="col-1">
              <button class="btn btn-secondary"><i class="fa-solid fa-pen-to-square"></i></button>
            </div>
            <div class='col-5'>Editar información</div>
          </div>
          <br>
          <div class="row align-items-center">
            <div class="col-1">
              <button  class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
            </div>
            <div class='col-5'>Eliminar registro</div>
            <div class="col-1">
              <button type="button" class="btn btn-success"><i class="bx bxs-file-pdf"></i></button>
            </div>
            <div class="col-5">Generar PDF</div>
          </div>
          <br>
          <div class="row align-items-center">
            <div class="col-6">
              <i class="bi bi-info-circle-fill"></i><p class="d-inline-flex"> &nbsp Ver información</p>
            </div>
          </div>
          <br>
          <div class="row">
            Todas las interfaces cuentan con botones similares, sin embargo estos pueden cambiar ligeramente. Lo mismo ocurre con los formularios.
            Simpre que los datos de los formularios estén incorrectos estos arrojarán un mensaje con el error correspondiente.
          </div>
  
          <br>
  
          <div class="row">
            <p>Para cualquier duda sobre la interfaz o inconvenientes con esta, favor de comunicarse con el administrador: <a class="d-inline-block" href="mailto: gymicetics@gmail.com">gymicetics@gmail.com</a></p>
          </div>
          
        </x-slot>
        <x-slot name='footer'>
          <button wire:click="$set('display', false)" class="btn btn-secondary">Cerrar</button>
        </x-slot>
      </x-dialog-modal>


      
</div>
