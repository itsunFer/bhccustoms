<x-gymLayout>
    <x-slot:title>
        Games
    </x-slot>
    <h1>Games</h1>
    

    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Map</th>
            <th score="col">Score</th>
            @if(Auth::user()->is_admin == true)
                <th></th>
                <th></th>
            @endif
            <th class='text-center' scope="col">Details</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($competencias as $comp)
                <tr>
                    <td>{{$comp->map}}</td>
                    <td>{{$comp->score}}</td>
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
                        <span>Add Game</span>
                    </a></td>
                </tr>
            @endif
        </tbody>
      </table>

    <x/slot>
</x-gymLayout>