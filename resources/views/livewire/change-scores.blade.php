<div>
    @foreach ($scores as $score)
        <div class=row>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Columna</th>
                        <th scope="col">Original</th>
                        <th scope="col">Edición</th>
                    </tr>
                </thead>
                <tbody class='align-items-center'>
                        <tr>
                            <td scope="row">Gimnasta</td>
                            <td>{{$score->scores->gimnastas->nombre_g}} {{$score->scores->gimnastas->apellido_g}}</td>
                            <td>{{$score->scoresN->gimnastas->nombre_g}} {{$score->scoresN->gimnastas->apellido_g}}</td>
                        </tr>
                        <tr>
                            <td scope="row">Ronda</td>
                            <td>{{$score->scores->rounds->nombre_r}}</td>
                            <td>{{$score->scoresN->rounds->nombre_r}}</td>
                        </tr>
                        <tr>
                            <td scope="row">Aparato</td>
                            <td>{{$score->scores->aparatos->nombre_a}}</td>
                            <td>{{$score->scoresN->aparatos->nombre_a}}</td>
                        </tr>
                        <tr>
                            <td scope="row">Dificultad</td>
                            <td>{{$score->scores->difficulty_s}}</td>
                            <td>{{$score->scoresN->difficulty_s}}</td>
                        </tr>
                        <tr>
                            <td scope="row">Ejecución</td>
                            <td>{{$score->scores->execution_s}}</td>
                            <td>{{$score->scoresN->execution_s}}</td>
                        </tr>
                        <tr>
                            <td scope="row">Deducciones</td>
                            <td>{{$score->scores->deductions_s}}</td>
                            <td>{{$score->scoresN->deductions_s}}</td>
                        </tr>
                        <tr>
                            <td scope="row">Total</td>
                            <td>{{$score->scores->total_s}}</td>
                            <td>{{$score->scoresN->total_s}}</td>
                        </tr>
                </tbody>
            </table>
        </div>
        <div class='row text-center'>
            <div class="col-6">
                <form action="{{route('changescore.aproveE', $score)}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class='text-center'>
                        <button class='btn btn-success'>✔</button>
                    </div>
                </form>
            </div>
            <div class="col-6">
                <form action="{{route('changescore.denyE', $score)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class='text-center'>
                        <button class='btn btn-danger'>✘</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
    <div class="row text-center">
        <div class="col-12">
            {{$scores->links()}}
        </div>
    </div>
    
</div>
