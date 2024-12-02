<x-gymLayout>
    <x-slot:title>
        Competencias
    </x-slot>
    <h1>Competencias</h1>
    

    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Tipo</th>
            @if(Auth::user()->is_admin == true)
                <th></th>
                <th></th>
            @endif
            <th class='text-center' scope="col">Ver detalle</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($competencias as $comp)
                <tr>
                    <td>{{$comp->nombre_c}}</td>
                    <td>
                        @switch($comp->tipo_c)
                            @case(1)
                                Nacional
                                @break
                            @case(2)
                                Regional
                                @break
                             @case(3)
                                Internacional
                                @break
                            @default
                                nada
                        @endswitch
                    </td>
                    @if(Auth::user()->is_admin == true)
                        <td>
                            <a href="{{route('competencia.edit', $comp->id)}}"><button type="button" class="btn btn-primary"><i class="bi bi-pencil-square"></i></button></a>
                        </td>
                        <td>
                            <form action="{{route('competencia.destroy', $comp)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class='text-center'>
                                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                                </div>
                            </form>
                        </td>
                    @endif 
                        <td class='text-center'>
                            <a href="/competencia/{{$comp->id}}">
                                <i class="bi bi-info-circle-fill"></i>
                            </a>
                        </td> 
                </tr>
            @endforeach
            @if(Auth::user()->is_admin == true)
                <tr>
                    <td><a href="{{route('competencia.create')}}">
                        <i class="bi bi-person-plus-fill"></i>
                        <span>Nueva competencia</span>
                    </a></td>
                </tr>
            @endif
        </tbody>
      </table>

    <x/slot>
</x-gymLayout>