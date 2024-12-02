<x-gymLayout>
    <x-slot:title>
        Imagenes
    </x-slot>
    <h1>Imagenes</h1>

    @if (Auth::user()->is_admin==true)
      <div class="col-md-3">
        <br>
        <a href="{{route('picture.controlP')}}"><button type="button" class="btn btn-success">Aprobar cambios</i></button></a>
      </div>
    @endif
    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Hash</th>
            <th scope="col">Nombre</th>
            <th scope="col">Mime</th>
            <th scope="col">Eliminar</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($pictures as $pic)
                <tr>
                    <td>{{$pic->id}}</td>
                    <td>{{$pic->hash}}</td>
                    <td>{{$pic->nombre}}</td>
                    <td>{{$pic->mime}}</td>
                    <td>
                        <form action="{{route('picture.destroy', $pic)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class='text-center'>
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
       
      </table>


    
    
    <x/slot>
</x-gymLayout>