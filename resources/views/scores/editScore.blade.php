<x-gymLayout>
    <x-slot:title>
      Editar puntuacion
    </x-slot>
    <h1>Editar puntuacion</h1>
    <form class="row g-3" action="{{route('score.update', $score->id)}}" method="POST">
      @csrf
      @method('PATCH')
      <div class="col-md-4">
        <label for="gimnastas_id" class="form-label">Gimnasta: </label> <br>
        <select name="gimnastas_id" id="gimnastas_id" class="form-control" required>
          @foreach($gimnastas as $gimnasta)
            <option value="{{$gimnasta->id}}" @if (old('gimnastas_id')==$gimnasta->id or $gimnasta->id==$score->gimnastas_id) 
                selected
            @endif>{{$gimnasta->nombre_g}} {{$gimnasta->apellido_g}}</option>
          @endforeach
        </select>
        @error('gimnastas_id')
              <h5>{{$message}}</h5>
          @enderror
      </div>

      <div class="col-md-4">
        <label for="rounds_id" class="form-label">Ronda: </label> <br>
        <select name="rounds_id" id="rounds_id" class="form-control" required>
          @foreach($rounds as $round)
            <option value="{{$round->id}}" @if (old('rounds_id')==$round->id or $round->id==$score->rounds_id) 
                selected
            @endif>{{$round->nombre_r}} ({{$round->clave_r}})</option>
          @endforeach
        </select>
        @error('rounds_id')
              <h5>{{$message}}</h5>
          @enderror
      </div>

      <div class="col-md-4">
        <label for="aparatos_id" class="form-label">Aparato: </label> <br>
        <select name="aparatos_id" id="aparatos_id" class="form-control" required>
          @foreach($aparatos as $aparato)
            <option value="{{$aparato->id}}" @if (old('aparatos_id')==$aparato->id or $aparato->id==$score->aparatos_id) 
                selected
            @endif>{{$aparato->nombre_a}} ({{$aparato->clave_a}})</option>
          @endforeach
        </select>
        @error('aparatos_id')
          <h5>{{$message}}</h5>
        @enderror
      </div>

      <div class="col-md-4">
        <label for="difficulty_s" class="form-label">Dificultad: </label>
        <input type="number" step="any" class="form-control" name="difficulty_s" id="difficulty_s" value="{{old('difficulty_s') ?? $score->difficulty_s}}" required>
          @error('difficulty_s')
              <h5>{{$message}}</h5>
          @enderror
      </div>

      <div class="col-md-4">
        <label for="execution_s" class="form-label">Ejecución: </label>
        <input type="number" step="any" class="form-control" name="execution_s" id="execution_s" value="{{old('execution_s') ?? $score->execution_s}}" required>
          @error('execution_s')
              <h5>{{$message}}</h5>
          @enderror
      </div>

      <div class="col-md-4">
        <label for="deductions_s" class="form-label">Deducciones: </label>
        <input type="number"step="any" class="form-control" name="deductions_s" id="deductions_s" value="{{old('deductions_s') ?? $score->deductions_s}}" required>
          @error('deductions_s')
              <h5>{{$message}}</h5>
          @enderror
      </div>

      <input type="hidden" name="events_id" id="events_id" value="{{$score->events_id}}">
      
      <div class="text-center">
        <button type="submit" class="btn btn-primary">Enviar</button>
        <button type="reset" class="btn btn-secondary">Limpiar</button>
      </div>
    </form>
</x-gymLayout>