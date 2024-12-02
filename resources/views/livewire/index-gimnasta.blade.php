<div>
    <div class='row'>
        <div class="col-md-4">
          <label for="paises">Pais</label>
          <select wire:model='paisesFilter' class="form-control" name="paises" id="paises">
            <option value="">--Seleccione</option>
            @foreach($paises as $pais)
              <option value="{{$pais->id}}">{{$pais->nombre_p}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-4">
            <label for="nombre_g">Nombre</label>
            <input type="text" wire:model='nombreFilter' class="form-control" name="nombre_g" id="nombre_g">
        </div>
        <div class="col-md-4">
            <br>
            <a href="{{route('gimnasta.json')}}"><button type="button"" class="btn btn-primary">Generar JSON</button></a>
        </div>
    </div>

    @php
        $hoy = getdate();
        $fecha = $hoy['year'] . '-' . $hoy['mon'] . '-' . $hoy['mday'];
        $fechaHoy = new DateTime($fecha);
    @endphp

    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Edad</th>
            <th scope="col">Fecha de nacimiento</th>
            <th scope="col">Pais</th>
            <th class='text-center' scope="col">Ver detalle</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($gimnastas as $gim)
                @php
                    $fechaN = new DateTime($gim->fecha_n_g);
                    $Diferencia = $fechaHoy ->diff($fechaN);
                @endphp
                <tr>
                    <td>{{$gim->nombre_g}}</td>
                    <td>{{$gim->apellido_g}}</td>
                    <td>{{$Diferencia -> format('%Y')}} años</td>
                    <td>{{$fechaN->format('d')}}-{{$fechaN->format('m')}}-{{$fechaN->format('Y')}}</td>
                    <td><x-dynamic-component component="flag-country-{{$gim->paises->iso2code_p}}" class="d-inline-block w-6 h-6"/> {{$gim->paises->nombre_p}}</td>
                    <td class='text-center'>
                        <a href="/gimnasta/{{$gim->id}}">
                             <i class="bi bi-info-circle-fill"></i>
                        </a>
                    </td>  
                </tr>
            @endforeach
            @if(Auth::user()->is_admin == true)
              <tr>
                  <td><a href="{{route('gimnasta.create')}}">
                      <i class="bi bi-person-plus-fill"></i>
                      <span>Agregar gimnasta</span>
                  </a></td>
              </tr>
            @endif
        </tbody>
      </table>
      
      {{$gimnastas->links()}}

      <div class="row">
        <div class="col-1">
          <button class='btn btn-outline-warning' wire:click="$set('display', true)"><i class="fa-solid fa-circle-question"></i></button>
        </div>
      </div> 

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
