<x-gymLayout>
    <x-slot:title>
      Editar foro
    </x-slot>
    <h1>Editar foro</h1>
    <form class="row g-3" action="{{route('forum.update', $forum)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="col-12">
          <label for="title" class="form-label">Titulo: </label>
          <input type="text" class="form-control" name="title" id="title" value={{old('title') ?? $forum->title}} required>
            @error('title')
                <h5>{{$message}}</h5>
            @enderror
        </div>

        <div class="col-12">
          <label for="content" class="form-label">Contenido: </label>
          <textarea class="form-control" name="content" id="content" required>{{ old('content') ?? $forum->content}}</textarea>
            @error('content')
                <h5>{{$message}}</h5>
            @enderror

        </div>
        <div class="col-12">
          <label>Etiquetas</label>
          @foreach ($tags as $tag)
              <label>
                  <input type="checkbox" name="selectedTags[]" value="{{ $tag->id }}"
                         {{ in_array($tag->id, $selectedTags) ? 'checked' : '' }}>
                  {{ $tag->tag_name }}
              </label>
          @endforeach
      </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Enviar</button>
          <button type="reset" class="btn btn-secondary">Limpiar</button>
        </div>
      </form><!-- Vertical Form -->

</x-gymLayout>