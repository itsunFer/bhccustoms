<div>
    <div class='row'>
        <div class="col-md-4">
            <label for="title">Title</label>
            <input type="text" wire:model='titleFilter' class="form-control" name="title" id="title">
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
            <th scope="col">Date</th>
            <th class='text-center' scope="col">Details</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($news as $article)
                <tr>
                    <td>{{$article->title}}</td>
                    <td>{{$article->created_at}}</td>
                    <td class='text-center'>
                        <a href="/news/{{$article->id}}">
                             <i class="bi bi-info-circle-fill"></i>
                        </a>
                    </td>  
                </tr>
            @endforeach
            @if(Auth::user()->is_admin == true)
              <tr>
                  <td><a href="{{route('news.create')}}">
                      <i class="bi bi-person-plus-fill"></i>
                      <span>Agregar noticia</span>
                  </a></td>
              </tr>
            @endif
        </tbody>
      </table>
</div>
