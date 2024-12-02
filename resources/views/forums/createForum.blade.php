<x-gymLayout>
    <x-slot:title>
      Nuevo foro
    </x-slot>
    <h1>Nuevo foro</h1>
    <form class="row g-3" action="/forum" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-12">
          <label for="title" class="form-label">Titulo: </label>
          <input type="text" class="form-control" name="title" id="title" value="{{old('title')}}" required>
            @error('title')
                <h5>{{$message}}</h5>
            @enderror
        </div>
        <div class="col-12">
          <label for="content" class="form-label">Contenido: </label>
          <textarea class="form-control" name="content" id="content" value="{{old('content')}}" required></textarea>
            @error('content')
                <h5>{{$message}}</h5>
            @enderror
        </div>
        <div class="col-12">
          <label for="tags">Elegir Etiquetas:</label><br>
          @foreach ($tags as $tag)
            <label>
              <input type="checkbox" name="selectedTags[]" value="{{ $tag->id }}">
              {{ $tag->tag_name }}
            </label>
          @endforeach
      </div>
  
      <div class="col-12">
          <label for="newTags">Nueva Etiqueta (Multiples etiquetas separadas por comas):</label>
          <input type="text" class="form-control" name="newTags" id="newTags" value="{{old('newTags')}}">
      </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Enviar</button>
          <button type="reset" class="btn btn-secondary">Limpiar</button>
        </div>
      </form><!-- Vertical Form -->

</x-gymLayout>