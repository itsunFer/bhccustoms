<div>
  <div class='row'>
    <div class="col-md-3">
      <label for="gimnastas">Players</label>
      <select wire:model='gimnastasFilter' class="form-control" name="gimnastas" id="gimnastas">
        <option value="">--Seleccione</option>
        @foreach($gimnastas as $players)
          <option value="{{$players->id}}">{{$players->gametag}}</option>
        @endforeach
      </select>
    </div>

    <div class="col-md-1">
      <br>
      <a href="{{route('score.create', $event)}}"><button type="button" class="btn btn-success">+</button></a>
    </div>
    <div class="col-md-1">
      <br>
      <a href="{{route('score.pdf', $event)}}" target="_blank"><button type="button" class="btn btn-success"><i class="bx bxs-file-pdf"></i></button></a>
    </div>

    @if (Auth::user()->is_admin==true)
      <div class="col-md-2">
        <br>
        <a href="{{route('event.controlI', $event)}}"><button type="button" class="btn btn-success">Aprobar cambios</i></button></a>
      </div>
      <div class="col-md-2">
        <br>
        <a href="{{route('changescore.index', $event)}}"><button type="button" class="btn btn-success">Aprobar ediciones</i></button></a>
      </div>
    @endif

      

  </div>
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
    <tbody>
        @foreach ($scores as $score)
            <tr>
                <td>{{$score->gimnastas->nombre_g}} {{$score->gimnastas->apellido_g}}</td>
                <td>{{$score->gimnastas->clave_r}}</td>
                <td>{{$score->aparatos->clave_a}}</td>
                <td>{{$score->difficulty_s}}</td>
                <td>{{$score->execution_s}}</td>
                <td>{{$score->deductions_s}}</td>
                <td>{{$score->total_s}}</td>
                <td>
                    <a href="{{route('score.edit', $score->id)}}"><button type="button" class="btn btn-primary"><i class="bi bi-pencil-square"></i></button></a>
                </td>
                <td>
                  @if(Auth::user()->is_admin == true)
                    <form action="{{route('score.destroy', $score)}}" method="POST">
                      @csrf
                      @method('DELETE')
                      <div class='text-center'>
                          <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                      </div>
                  </form>
                  @endif
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>
</div>
