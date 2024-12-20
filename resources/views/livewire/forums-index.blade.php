<div>
    <div class='row'>
        <div class="col-md-4">
            <label for="title">Title</label>
            <input type="text" wire:model='titleFilter' class="form-control" name="title" id="title">
        </div>
        <div class="col-md-4">
            <label for="author">Author</label>
            <input type="text" wire:model='authorFilter' class="form-control" name="author" id="author">
        </div>
        <div class="col-md-4">
          <label for="tagFilter">Tags:</label>
          <select wire:model="selectedTag" class="form-control" id="tagFilter">
              <option value="">All Tags</option>
              @foreach ($tags as $tag)
                  <option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
              @endforeach
          </select>
      </div>
    </div>

    @php
        $hoy = getdate();
        $fecha = $hoy['year'] . '-' . $hoy['mon'] . '-' . $hoy['mday'];
        $fechaHoy = new DateTime($fecha);
    @endphp

    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Title</th>
            <th scope="col">Author</th>
            <th scope="col">Date</th>
            <th scope="col">Tags</th>
            <th class='text-center' scope="col">Details</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($forums as $forum)
                <tr>
                    <td>{{$forum->title}}</td>
                    <td>{{ $forum->author->name }}</td>
                    <td>{{$forum->created_at}}</td>
                    <td>
                      @php
                          $displayedTags = $forum->tags->take(3);
                          $remainingTags = $forum->tags->slice(3);
                      @endphp

                      @foreach ($displayedTags as $tag)
                          <span class="badge bg-primary">{{ $tag->tag_name }}</span>
                      @endforeach

                      @if ($remainingTags->isNotEmpty())
                          <span class="badge bg-secondary">+ {{ $remainingTags->count() }} more</span>
                      @endif
                    </td>
                    <td class='text-center'>
                        <a href="/forum/{{$forum->id}}">
                             <i class="bi bi-info-circle-fill"></i>
                        </a>
                    </td>  
                </tr>
            @endforeach
              <tr>
                  <td><a href="{{route('forum.create')}}">
                      <i class="bi bi-person-plus-fill"></i>
                      <span>Agregar foro</span>
                  </a></td>
              </tr>
        </tbody>
      </table>    
</div>

