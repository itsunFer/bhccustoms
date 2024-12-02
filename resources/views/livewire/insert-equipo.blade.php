<div>
    @if(Auth::user()->is_admin==true)
      <button wire:click="$set('display', true)" type="button" class="btn btn-primary">Añadir</button>
    @endif
    

    <x-dialog-modal wire:model='display'>
        <x-slot name='title'> Nuevo equipo</x-slot>
        <x-slot name='content'>
            <form wire:submit.prevent="save" class="row g-3" method="POST">
                @csrf
                <div class="col-md-6">
                  <label for="paises_id" class="form-label">Pais: </label> <br>
                  <select name="paises_id" id="paises_id" class="form-control" wire:model='paises_id' required>
                    <option value="">-</option>
                    @foreach($paises as $pais)
                      <option value="{{$pais->id}}" @if (old('paises_id')==$pais->id) 
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
                        <option value="{{$event->id}}" @if (old('event_id')==$event->id) 
                            selected
                        @endif>{{$event->nombre_e}}</option>
                      @endforeach
                    </select>
                    @error('events_id') <span class="error">{{ $message }}</span> @enderror
                </div>
                
                <div class="col-12 text-center">
                  <button wire.click="save" type="submit" class="btn btn-primary">Enviar</button>
                  <button type="button" class="btn btn-secondary">Limpiar</button>
                </div>
              </form>
        </x-slot>
        <x-slot name='footer'>
            <button wire:click="$set('display', false)" type="button" class="btn btn-secondary">Cerrar</button>
        </x-slot>
    </x-dialog-modal>
</div>
