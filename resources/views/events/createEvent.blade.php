<x-gymLayout>
    <x-slot:title>
      Añadir evento
    </x-slot>
    <h1>Añadir evento</h1>
    <form class="row g-3" action="{{route('event.store')}}" method="POST" required>
        @csrf
        <div class="col-12">
          <label for="nombre_e" class="form-label">Nombre: </label>
          <input type="text" class="form-control" name="nombre_e" id="nombre_e" value="{{old('nombre_e')}}" required>
            @error('nombre_e')
                <h5>{{$message}}</h5>
            @enderror
        </div>
        <div class="col-12">
          <label for="fecha_i_e" class="form-label">Fecha de inicio: </label>
          <input type="date" class="form-control" name="fecha_i_e" id="fecha_i_e" value="{{old('fecha_i_e')}}" required>
            @error('fecha_i_e')
                <h5>{{$message}}</h5>
            @enderror
        </div>
        <div class="col-12">
            <label for="fecha_f_e" class="form-label">Fecha de fin: </label>
            <input type="date" class="form-control" name="fecha_f_e" id="fecha_f_e" value="{{old('fecha_f_e')}}" required>
              @error('fecha_f_e')
                  <h5>{{$message}}</h5>
              @enderror
          </div>
        <div class="col-12">
          <label for="paises_id" class="form-label">Pais: </label> <br>
          <select class="form-control" name="paises_id" id="paises_id" required>
            @foreach($paises as $cont)
              <option value="{{$cont->id}}" @if (old('paises_id')==$cont->id) 
                  selected
              @endif>{{$cont->nombre_p}}</option>
            @endforeach
          </select>
        </div>
        <input type="hidden" name="competencias_id" id="competencias_id" value="{{$competencia->id}}">
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Enviar</button>
          <button type="reset" class="btn btn-secondary">Limpiar</button>
        </div>
      </form><!-- Vertical Form -->

</x-gymLayout>