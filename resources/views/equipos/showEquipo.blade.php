<x-gymLayout>
    <x-slot:title>
      Ver equipo
    </x-slot>
    <h1>Equipo de {{$equipo->paises->nombre_p}} durante {{$equipo->events->nombre_e}}</h1>

   
    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Gimnasta</th>
            <th scope="col">Situación</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($equipo->gimnastas as $gimnasta)
                <tr>
                    <td>{{$gimnasta->nombre_g}} {{$gimnasta->apellido_g}}</td>
                    <td>
                        @if ($gimnasta->pivot->alternate_g==0)
                            TITULAR  
                        @else
                            SUPLENTE
                        @endif
                    </td>
            @endforeach
        </tbody>
      </table>

      @if(Auth::user()->is_admin == true)
        <form class="row g-3" action="{{route('equipo.admin', $equipo)}}" method="POST">
          @csrf
          <div class="col-12">
              <select name="gimnasta_id[]" multiple class="form-control">
                  @foreach ($gimnastas as $gimnasta)
                      <option value="{{ $gimnasta->id }}"
                          @selected(array_search($gimnasta->id, $equipo->gimnastas()->pluck('id')->toArray()) !== false)
                      >
                          {{$gimnasta->nombre_g}} {{$gimnasta->apellido_g}}
                      </option>
                  @endforeach
              </select>
          </div>
          <div class="col-12">
            <input type="radio" id="alternate_g" name="alternate_g" value="true">
            <label for="alternate_g">Suplente</label><br>
            <input type="radio" id="nonalternate_g" name="alternate_g" value="false">
            <label for="nonalternate_g">Titular</label><br>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-primary">Enviar</button>
            <button type="reset" class="btn btn-secondary">Limpiar</button>
          </div>
        </form>
      @endif
</x-gymLayout>