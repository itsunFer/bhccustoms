<x-gymLayout>
    <x-slot:title>
      Editar evento
    </x-slot>
    <h1>Editar evento</h1>
    <form class="row g-3" action="{{route('event.update', $event->id)}}" method="POST">
        @csrf
        @method('PATCH')
        <div class="col-12">
          <label for="nombre_e" class="form-label">Nombre: </label>
          <input type="text" class="form-control" name="nombre_e" id="nombre_e" value="{{old('nombre_e') ?? $event->nombre_e}}" required>
            @error('nombre_e')
                <h5>{{$message}}</h5>
            @enderror
        </div>
        <div class="col-12">
          <label for="fecha_i_e" class="form-label">Fecha de inicio: </label>
          <input type="date" class="form-control" name="fecha_i_e" id="fecha_i_e" value="{{old('fecha_i_e') ?? $event->fecha_i_e}}" required>
            @error('fecha_i_e')
                <h5>{{$message}}</h5>
            @enderror
        </div>
        <div class="col-12">
            <label for="fecha_f_e" class="form-label">Fecha de fin: </label>
            <input type="date" class="form-control" name="fecha_f_e" id="fecha_f_e" value="{{old('fecha_f_e') ?? $event->fecha_f_e}}" required>
              @error('fecha_f_e')
                  <h5>{{$message}}</h5>
              @enderror
          </div>
        <div class="col-12">
          <label for="paises_id" class="form-label">Pais: </label> <br>
          <select class="form-control" name="paises_id" id="paises_id" required>
            @foreach($paises as $cont)
              <option value="{{$cont->id}}" @if (old('paises_id')==$cont->id or $cont->id==$event->paises_id) 
                  selected
              @endif>{{$cont->nombre_p}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-12">
            <label for="competencias_id" class="form-label">Competencia: </label> <br>
            <select class="form-control" name="competencias_id" id="competencias_id" required>
              @foreach($competencias as $competencia)
                <option value="{{$competencia->id}}" @if (old('paises_id')==$competencia->id or $competencia->id==$event->competencias_id) 
                    selected
                @endif>{{$competencia->nombre_c}}</option>
              @endforeach
            </select>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Enviar</button>
          <button type="reset" class="btn btn-secondary">Limpiar</button>
        </div>
      </form><!-- Vertical Form -->

</x-gymLayout>