<x-gymLayout>
    <x-slot:title>
        Crear competencias
    </x-slot>
    <h1>Añadir competencias</h1>
    <form class="row g-3" action="/competencia" method="POST">
        @csrf

        <div class="col-12">
          <label for="nombre_c" class="form-label">Nombre: </label>
          <input type="text" class="form-control" name="nombre_c" id="nombre_c" required value="{{old('nombre_c')}}" >
            @error('nombre_c')
                <h5>{{$message}}</h5>
            @enderror
        </div>

        <div class="col-12">
          <label for="tipo_c" class="form-label">Tipo: </label> <br>
          <select name="tipo_c"  class="form-control" id="tipo_c" required>
            <option value="1" @if (old('tipo_c')==1) 
                  selected
              @endif>Nacional</option>
              <option value="2" @if (old('tipo_c')==2) 
                  selected
              @endif>Regional</option>
              <option value="3" @if (old('tipo_c')==3) 
                  selected
              @endif>Internacional</option>
          </select>
          @error('tipo_c')
                <h5>{{$message}}</h5>
            @enderror
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Enviar</button>
            <button type="reset" class="btn btn-secondary">Limpiar</button>
        </div>
      </form><!-- Vertical Form -->
    <x/slot>
</x-gymLayout>