<x-gymLayout>
    <x-slot:title>
        {{$competencia->nombre_c}}
    </x-slot>
    <h1>{{$competencia->nombre_c}}</h1>
    
    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Inicio</th>
            <th scope="col">Fin</th>
            <th scope="col">Pais</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th class='text-center' scope="col">Resultados</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
                @php
                    $fechaI = new DateTime($event->fecha_i_e);
                    $fechaF = new DateTime($event->fecha_f_e);
                @endphp
                <tr>
                    <td>{{$event->nombre_e}}</td>
                    <td>{{$fechaI->format('d')}}-{{$fechaI->format('m')}}-{{$fechaI->format('Y')}}</td>
                    <td>{{$fechaF->format('d')}}-{{$fechaF->format('m')}}-{{$fechaF->format('Y')}}</td>
                    <td><x-dynamic-component component="flag-country-{{$event->paises->iso2code_p}}" class="d-inline-block w-6 h-6"/> {{$event->paises->nombre_p}}</td>
                    <td>
                        @if(Auth::user()->is_admin == true)    
                            <a href="{{route('event.edit', $event->id)}}"><button type="button" class="btn btn-primary">Editar</button></a>
                        @endif
                    </td>
                    <td>
                        @if(Auth::user()->is_admin == true)
                            <form action="{{route('event.destroy', $event)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class='text-center'>
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </div>
                            </form>
                        @endif
                    </td>
                    <td class='text-center'>
                        <a href={{route('event.show', $event->id)}}>
                             <i class="bi bi-info-circle-fill"></i>
                        </a>
                    </td>  
                </tr>
            @endforeach
            <tr>
                <td><a href="{{route('event.newEvent', $competencia->id)}}">
                    <i class="bi bi-clipboard-plus"></i>
                    <span>Nueva</span>
                </a></td>
            </tr>
        </tbody>
      </table>

    <x/slot>
</x-gymLayout>