<x-gymLayout>
    <x-slot:title>
        Aprobación de inserciones {{$event->nombre_e}}
    </x-slot>
    <h1>Aprobación de inserciones {{$event->nombre_e}}</h1>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Gimnasta</th>
                <th scope="col">Ron</th>
                <th scope="col">Ap</th>
                <th scope="col">Dif</th>
                <th scope="col">Ej</th>
                <th scope="col">Ded</th>
                <th scope="col">Total</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody class='align-items-center'>
            @foreach ($scores as $score)
                <tr>
                    <td>{{$score->gimnastas->nombre_g}} {{$score->gimnastas->apellido_g}}</td>
                    <td>{{$score->rounds->clave_r}}</td>
                    <td>{{$score->aparatos->clave_a}}</td>
                    <td>{{$score->difficulty_s}}</td>
                    <td>{{$score->execution_s}}</td>
                    <td>{{$score->deductions_s}}</td>
                    <td>{{$score->total_s}}</td>
                    <td>
                        <form action="{{route('score.aproveI', $score)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class='text-center'>
                                <button class='btn btn-success'>✔</button>
                            </div>
                        </form>
                    </td>
                    <td>
                        <form action="{{route('score.denyI', $score)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class='text-center'>
                                <button class='btn btn-danger'>✘</button>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
  </table>
</x-gymLayout>