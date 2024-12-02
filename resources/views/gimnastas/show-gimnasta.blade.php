<x-gymLayout>
    <x-slot:title>
      Ver: {{$gimnasta->nombre_g}} {{$gimnasta->apellido_g}}
    </x-slot>
    @php
        $hoy = getdate();
        $fecha = $hoy['year'] . '-' . $hoy['mon'] . '-' . $hoy['mday'];
        $fechaHoy = new DateTime($fecha);
        $fechaN = new DateTime($gimnasta->fecha_n_g);
        $Diferencia = $fechaHoy ->diff($fechaN);
    @endphp
    <h1>{{$gimnasta->nombre_g}} {{$gimnasta->apellido_g}}</h1>
    <div class='row'>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Detalles</h5>
                @php
                $route="";
                if(sizeof($imagen)!=0){
                    $im = $imagen[0];
                    $route = $im->hash;
                }
            @endphp
            <img src="{{Storage::url($route)}}" alt="">
            <a href="{{route('gimnasta.galeria', $gimnasta->id)}}"><i class="bi bi-card-image"></i></a>
                <!-- Default Table -->
                <table class="table">
                    <tbody>
                    <tr>
                        <th scope="row">Nombre</th>
                        <td>{{$gimnasta->nombre_g}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Apellido</th>
                        <td>{{$gimnasta->apellido_g}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Nacimiento</th>
                        <td>{{$fechaN->format('d')}}-{{$fechaN->format('m')}}-{{$fechaN->format('Y')}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Edad</th>
                        <td>{{$Diferencia -> format('%Y')}} años</td>
                    </tr>
                    <tr>
                        <th scope="row">Pais</th>
                        <td>{{$gimnasta->paises->nombre_p}} <x-dynamic-component component="flag-country-{{$gimnasta->paises->iso2code_p}}" class="d-inline-block w-6 h-6"/></td>
                    </tr>
                    </tbody>
                </table>
                <!-- End Default Table Example -->
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Información</h5>
                    <p>{{$gimnasta->nombre_g}} {{$gimnasta->apellido_g}} es una gimnasta artística de {{$gimnasta->paises->nombre_p}} nacida el {{$fechaN->format('d')}} de 
                        @switch($fechaN->format('m'))
                            @case(1)
                                enero
                                @break
                            @case(2)
                                febrero
                                @break
                            @case(3)
                                marzo
                                @break
                            @case(4)
                                abril
                                @break
                            @case(5)
                                mayo
                                @break
                            @case(6)
                                junio
                                @break
                            @case(7)
                                julio
                                @break
                            @case(8)
                                agosto
                                @break
                            @case(9)
                                septiembre
                                @break
                            @case(10)
                                octubre
                                @break
                            @case(11)
                                noviembre
                                @break
                            @case(12)
                                diciembre
                                @break
                            @default
                                nada
                        @endswitch
                        de {{$fechaN->format('Y')}} ({{$Diferencia -> format('%Y')}} años).
                    </p>
                    @if(Auth::user()->is_admin == true)
                        <form action="{{route('gimnasta.destroy', $gimnasta)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class='text-center'>
                                <a href="{{route('gimnasta.edit', $gimnasta)}}"><button type="button" class="btn btn-primary">Editar</button></a>
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </div>
                        </form>
                    @endif
                    @if ($gimnasta->paises->nombre_p=="Italia")
                        <br>
                        <div class="text-center">
                            <span class="bg-success">#it</span><span class="text-dark">alg</span><span class="bg-danger">ym</span> 
                        </div>
                    @endif
                </div>
            </div>
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('picture.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="picture" class="form-label">Agregar imágenes</label>
                                <input class="form-control" type="file" id="picture" name="picture">
                            </div>
                        
                            <input type="hidden" name="gimnastas_id" id="gimnastas_id" value="{{$gimnasta->id}}">
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-outline-secondary">Subir</button>
                            </div>
                            @error('picture')
                                <h5>{{$message}}</h5>
                            @enderror
                        </form>
                    </div>
                </div>
        </div>
    </div>
    @section('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        @if(session('gimnasta')== 'editada')
            <script>
                Swal.fire(
                    '¡Éxito!',
                    'Registro modificado.',
                    'info'
                )
            </script>
        @endif
    @endsection
</x-gymLayout>