<x-gymLayout>
    <x-slot:title>
      Editar noticia
    </x-slot>
    <h1>Editar noticia</h1>
    <form class="row g-3" action="{{route('news.update', $news)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="col-12">
          <label for="title" class="form-label">Titulo: </label>
          <input type="text" class="form-control" name="title" id="title" value={{old('title') ?? $news->title}} required>
            @error('title')
                <h5>{{$message}}</h5>
            @enderror
        </div>

        <div class="col-12">
          <label for="content" class="form-label">Noticia: </label>
          <textarea class="form-control" name="content" id="content" required>{{ old('content') ?? $news->content}}</textarea>
            @error('content')
                <h5>{{$message}}</h5>
            @enderror

        </div>
        <div class="col-12">
            <label for="image" class="form-label">Imagen (opcional):</label>
            <input type="file" name="image" id="image">
            @error('image')
                <h5>{{$message}}</h5>
            @enderror
        </div>    

        <div class="text-center">
          <button type="submit" class="btn btn-primary">Enviar</button>
          <button type="reset" class="btn btn-secondary">Limpiar</button>
        </div>
      </form><!-- Vertical Form -->

</x-gymLayout>