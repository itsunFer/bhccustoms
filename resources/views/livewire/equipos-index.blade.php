<div>
    <div class='row'>
        <div class="col-md-3">
          <label for="rounds">Pais</label>
          <select wire:model='paisesFilter' class="form-control" name="paises" id="paises">
            <option value="">--Seleccione</option>
            @foreach($paises as $pais)
              <option value="{{$pais->id}}">{{$pais->nombre_p}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-3">
          <label for="events" class="d-inline">Evento</label>
          <select wire:model='eventsFilter' class="form-control d-inline" name="events" id="events">
            <option value="">--Seleccione</option>
              @foreach($events as $event)
                <option value="{{$event->id}}">{{$event->nombre_e}}</option>
              @endforeach
          </select>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Pais</th>
            <th scope="col">Evento</th>
            @if(Auth::user()->is_admin==true)
              <th scope="col"></th>
              <th scope="col"></th>
            @endif
            <th scope="col" class='text-center'>Ver gimnastas</th>
          </tr>
        </thead>
        <tbody>
            @foreach($equipos as $equipo)
                <tr>
                    <td><x-dynamic-component component="flag-country-{{$equipo->paises->iso2code_p}}" class="d-inline-block w-6 h-6"/> {{$equipo->paises->nombre_p}}</td>
                    <td>{{$equipo->events->nombre_e}}</td>
                    @if(Auth::user()->is_admin==true)
                      <td><button type="button" wire:click="edit({{$equipo}})" class="btn btn-primary"><i class="bi bi-pencil-square"></i></button></td>
                      <td>
                        <form action="{{route('equipo.destroy', $equipo)}}" method="POST">
                          @csrf
                          @method('DELETE')
                          <div class='text-center'>
                              <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                          </div>
                        </form>
                      </td>
                    @endif
                    <td class='text-center'>
                        <a href="{{route('equipo.show', $equipo)}}">
                            <i class="bi bi-info-circle-fill"></i>
                        </a>
                    </td> 
                </tr>
            @endforeach
        </tbody>
      </table>
      {{$equipos->links()}}


      <x-dialog-modal wire:model='displayEdit'>
        <x-slot name='title'> Editar equipo</x-slot>
        <x-slot name='content'>
            <form wire:submit.prevent="update" class="row g-3" method="POST">
                @csrf
                <div class="col-md-6">
                  <label for="paises_id" class="form-label">Pais: </label> <br>
                  <select name="paises_id" id="paises_id" class="form-control" wire:model='paises_id' required>
                    <option value="">-</option>
                    @foreach($paises as $pais)
                      <option value="{{$pais->id}}" @if ($pais->id == $equipo->paises_id) 
                          selected
                      @endif>{{$pais->nombre_p}}</option>
                    @endforeach
                  </select>
                    @error('paises_id') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6">
                    <label for="events_id" class="form-label">Evento: </label> <br>
                    <select name="events_id" id="events_id" class="form-control" wire:model='events_id' required>
                        <option value="">-</option>
                      @foreach($events as $event)
                        <option value="{{$event->id}}" @if ($event->id == $equipo->events_id) 
                            selected
                        @endif>{{$event->nombre_e}}</option>
                      @endforeach
                    </select>
                    @error('events_id') <span class="error">{{ $message }}</span> @enderror
                </div>
                
                <div class="col-12 text-center">
                  <button wire.click="update" type="submit" class="btn btn-primary">Enviar</button>
                  <button type="reset" class="btn btn-secondary">Limpiar</button>
                </div>
              </form>
        </x-slot>
        <x-slot name='footer'>
            <button wire:click="$set('displayEdit', false)" type="button" class="btn btn-secondary">Cerrar</button>
        </x-slot>
    </x-dialog-modal>
</div>
