<div>
    <div class='row'>
        <div class="col-md-4">
            <label for="title">Titulo</label>
            <input type="text" wire:model='titleFilter' class="form-control" name="title" id="title">
        </div>
        <div class="col-md-4">
            <label for="author">Autor</label>
            <input type="text" wire:model='authorFilter' class="form-control" name="author" id="author">
        </div>
        <div class="col-md-4">
          <label for="tagFilter">Etiqueta:</label>
          <select wire:model="selectedTag" class="form-control" id="tagFilter">
              <option value="">Todas las Etiquetas</option>
              @foreach ($tags as $tag)
                  <option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
              @endforeach
          </select>
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
            <th scope="col">Titulo</th>
            <th scope="col">Autor</th>
            <th scope="col">Fecha de publicacion</th>
            <th scope="col">Etiquetas</th>
            <th class='text-center' scope="col">Ver detalle</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($forums as $forum)
                <tr>
                    <td>{{$forum->title}}</td>
                    <td>{{ $forum->author->name }}</td>
                    <td>{{$forum->created_at}}</td>
                    <td>
                      @php
                          $displayedTags = $forum->tags->take(3);
                          $remainingTags = $forum->tags->slice(3);
                      @endphp

                      @foreach ($displayedTags as $tag)
                          <span class="badge bg-primary">{{ $tag->tag_name }}</span>
                      @endforeach

                      @if ($remainingTags->isNotEmpty())
                          <span class="badge bg-secondary">+ {{ $remainingTags->count() }} more</span>
                      @endif
                    </td>
                    <td class='text-center'>
                        <a href="/forum/{{$forum->id}}">
                             <i class="bi bi-info-circle-fill"></i>
                        </a>
                    </td>  
                </tr>
            @endforeach
              <tr>
                  <td><a href="{{route('forum.create')}}">
                      <i class="bi bi-person-plus-fill"></i>
                      <span>Agregar foro</span>
                  </a></td>
              </tr>
        </tbody>
      </table>
      
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

