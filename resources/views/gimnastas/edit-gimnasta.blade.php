<x-gymLayout>
    <x-slot:title>
      Editar gimnasta
    </x-slot>
    <h1>Editar gimnasta</h1>
    <form class="row g-3" action="{{route('gimnasta.update', $gimnasta)}}" method="POST">
        @csrf
        @method('PATCH')
        <div class="col-12">
          <label for="nombre_g" class="form-label">Nombre: </label>
          <input type="text" class="form-control" name="nombre_g" id="nombre_g" value={{old('nombre_g') ?? $gimnasta->nombre_g}} required>
            @error('nombre_g')
                <h5>{{$message}}</h5>
            @enderror
        </div>

        <div class="col-12">
          <label for="apellido_g" class="form-label">Apellido: </label>
          <input type="text" class="form-control" name="apellido_g" id="apellido_g" value={{old('apellido_g') ?? $gimnasta->apellido_g}} required>
            @error('apellido_g')
                <h5>{{$message}}</h5>
            @enderror
        </div>

        <div class="col-12">
          <label for="fecha_n_g" class="form-label">Fecha de nacimiento: </label>
          <input type="date" class="form-control" name="fecha_n_g" id="fecha_n_g" value={{old('fecha_n_g') ?? $gimnasta->fecha_n_g}} required>
            @error('fecha_n_g')
                <h5>{{$message}}</h5>
            @enderror
        </div>

        <div class="col-12">
          <label for="paises_id" class="form-label">Pais: </label> <br>
          <select class="form-control" name="paises_id" id="paises_id" value={{old('paises_id')}} required>
            @foreach($paises as $cont)
              <option value="{{$cont->id}}" @if (old('paises_id')==$cont->id or $cont->id==$gimnasta->paises_id)
                  selected
              @endif>{{$cont->nombre_p}}</option>
            @endforeach
          </select>
        </div>

        <div class="text-center">
          <button type="submit" class="btn btn-primary">Enviar</button>
          <button type="reset" class="btn btn-secondary">Limpiar</button>
        </div>
      </form><!-- Vertical Form -->

</x-gymLayout>