<x-gymLayout>
    <x-slot:title>
      Add player
    </x-slot>
    <h1>Add player</h1>
    <form class="row g-3" action="/gimnasta" method="POST">
        @csrf
        <div class="col-12">
          <label for="nombre_g" class="form-label">Name: </label>
          <input type="text" class="form-control" name="nombre_g" id="nombre_g" value="{{old('nombre_g')}}" required>
            @error('nombre_g')
                <h5>{{$message}}</h5>
            @enderror
        </div>
        <div class="col-12">
          <label for="gametag" class="form-label">Gametag: </label>
          <input type="text" class="form-control" name="gametag" id="gametag" value="{{old('gametag')}}" required>
            @error('gametag')
                <h5>{{$message}}</h5>
            @enderror
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Send</button>
          <button type="reset" class="btn btn-secondary">Clear</button>
        </div>
      </form><!-- Vertical Form -->

</x-gymLayout>