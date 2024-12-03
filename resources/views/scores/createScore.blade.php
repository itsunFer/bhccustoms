<x-gymLayout>
    <x-slot:title>
      Add player to game
    </x-slot>
    <h1>Add player to game</h1>
    <form class="row g-3" action="{{route('score.store')}}" method="POST">
      @csrf
      <div class="col-md-4">
        <label for="gametag" class="form-label">Player: </label> <br>
        <select name="gametag" id="gametag" class="form-control" required>
          @foreach($gimnastas as $gimnasta)
            <option value="{{$gimnasta->gametag}}">{{$gimnasta->gametag}}</option>
          @endforeach
        </select>
        @error('gametag')
              <h5>{{$message}}</h5>
          @enderror
      </div>

      <div class="col-md-4">
        <label for="winloss" class="form-label">W/L: </label> <br>
        <input name="winloss" id="winloss" class="form-control" required>
        @error('winloss')
              <h5>{{$message}}</h5>
          @enderror
      </div>

      <div class="col-md-4">
        <label for="acs" class="form-label">ACS: </label> <br>
        <input name="acs" id="acs" class="form-control" required>
        @error('acs')
              <h5>{{$message}}</h5>
          @enderror
      </div>
      
      <div class="col-md-4">
        <label for="kills" class="form-label">K: </label> <br>
        <input name="kills" id="kills" class="form-control" required>
        @error('kills')
              <h5>{{$message}}</h5>
          @enderror
      </div>

      <div class="col-md-4">
        <label for="deaths" class="form-label">D: </label> <br>
        <input name="deaths" id="deaths" class="form-control" required>
        @error('deaths')
              <h5>{{$message}}</h5>
          @enderror
      </div>

      <div class="col-md-4">
        <label for="assists" class="form-label">A: </label> <br>
        <input name="assists" id="assists" class="form-control" required>
        @error('assists')
              <h5>{{$message}}</h5>
          @enderror
      </div>

      <div class="col-md-4">
        <label for="dd" class="form-label">DD: </label> <br>
        <input name="dd" id="dd" class="form-control" required>
        @error('dd')
              <h5>{{$message}}</h5>
          @enderror
      </div>

      <div class="col-md-4">
        <label for="adr" class="form-label">ADR: </label> <br>
        <input name="adr" id="adr" class="form-control" required>
        @error('adr')
              <h5>{{$message}}</h5>
          @enderror
      </div>

      <div class="col-md-4">
        <label for="hs" class="form-label">HS (decimal): </label> <br>
        <input name="hs" id="hs" class="form-control" required>
        @error('hs')
              <h5>{{$message}}</h5>
          @enderror
      </div>

      <div class="col-md-4">
        <label for="kast" class="form-label">KAST (decimal): </label> <br>
        <input name="kast" id="kast" class="form-control" required>
        @error('kast')
              <h5>{{$message}}</h5>
          @enderror
      </div>

      <div class="col-md-4">
        <label for="fk" class="form-label">FK: </label> <br>
        <input name="fk" id="fk" class="form-control" required>
        @error('fk')
              <h5>{{$message}}</h5>
          @enderror
      </div>

      <div class="col-md-4">
        <label for="fd" class="form-label">FD: </label> <br>
        <input name="fd" id="fd" class="form-control" required>
        @error('fd')
              <h5>{{$message}}</h5>
          @enderror
      </div>

      <div class="col-md-4">
        <label for="rank" class="form-label">Rank: </label> <br>
        <input name="rank" id="rank" class="form-control" required>
      </div>

      <div class="col-md-4">
        <label for="plants" class="form-label">Plants: </label> <br>
        <input name="plants" id="plants" class="form-control" required>
        @error('plants')
              <h5>{{$message}}</h5>
          @enderror
      </div>

      <div class="col-md-4">
        <label for="defuses" class="form-label">Defuses: </label> <br>
        <input name="defuses" id="defuses" class="form-control" required>
        @error('defuses')
              <h5>{{$message}}</h5>
          @enderror
      </div>

      <input type="hidden" name="competencias_id" id="competencias_id" value="{{$competencia->id}}">
      
      <div class="text-center">
        <button type="submit" class="btn btn-primary">Send</button>
        <button type="reset" class="btn btn-secondary">Clear</button>
      </div>
    </form>
</x-gymLayout>