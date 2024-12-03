<x-gymLayout>
    <x-slot:title>
        Edit Game
    </x-slot>
    <h1>Edit {{$competencia->map}} {{$competencia->score}}</h1>
    <form class="row g-3" action="{{route('competencia.update', $competencia)}}" method="POST">
        @csrf
        @method('PATCH')

        <div class="col-12">
          <label for="map" class="form-label">Map: </label> <br>
          <select name="map"  class="form-control" id="map" required>
            <option value="Abyss" >Abyss</option>
            <option value="Ascent" >Ascent</option>
            <option value="Bind" >Bind</option>
            <option value="Breeze" >Breeze</option>
            <option value="Fracture" >Fracture</option>
            <option value="Haven">Haven</option>
            <option value="Icebox">Icebox</option>
            <option value="Lotus">Lotus</option>
            <option value="Pearl">Pearl</option>
            <option value="Split">Split</option>
            <option value="Sunset">Sunset</option>
          </select>
          @error('map')
                <h5>{{$message}}</h5>
            @enderror
        </div>

        <div class="col-12">
          <label for="score" class="form-label">Score: </label>
          <input type="text" class="form-control" name="score" id="score" required value={{old('score') ?? $competencia->score}}>
            @error('score')
                <h5>{{$message}}</h5>
            @enderror
        </div>

        <div class="col-12">
          <label for="winners" class="form-label">Winners: </label>
          <input type="text" class="form-control" name="winners" id="winners" required value={{old('winners') ?? $competencia->winners}}>
            @error('winners')
                <h5>{{$message}}</h5>
            @enderror
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Send</button>
            <button type="reset" class="btn btn-secondary">Clear</button>
        </div>
      </form><!-- Vertical Form -->
    <x/slot>
</x-gymLayout>