<div>
    <div class='row'>
        <div class="col-md-4">
          <label for="rounds">Ronda</label>
          <select wire:model='roundsFilter' class="form-control" name="rounds" id="rounds">
            <option value="">--Seleccione</option>
            @foreach($rounds as $round)
              <option value="{{$round->id}}">{{$round->nombre_r}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-4">
          <label for="aparatos" class="d-inline">Aparato</label>
          <select wire:model='aparatosFilter' class="form-control d-inline" name="aparatos" id="aparatos">
            <option value="">--Seleccione</option>
              @foreach($aparatos as $aparato)
                <option value="{{$aparato->id}}">{{$aparato->nombre_a}}</option>
              @endforeach
          </select>
        </div>
        <div class="col-md-4">
            <label for="events" class="d-inline">Evento</label>
            <select wire:model='eventsFilter' class="form-control d-inline" name="events" id="events">
              <option value="">--Seleccione</option>
                @foreach($events as $event)
                  <option value="{{$event->id}}">{{$event->nombre_e}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Gimnasta</th>
            <th scope="col">Evento</th>
            <th scope="col">Ron</th>
            <th scope="col">Ap</th>
            <th scope="col">Dif</th>
            <th scope="col">Ej</th>
            <th scope="col">Ded</th>
            <th scope="col">Total</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($scores as $score)
                <tr>
                    <td>{{$score->gimnastas->nombre_g}} {{$score->gimnastas->apellido_g}}</td>
                    <td> {{$score->events->nombre_e}} </td>
                    <td>{{$score->rounds->clave_r}}</td>
                    <td>{{$score->aparatos->clave_a}}</td>
                    <td>{{$score->difficulty_s}}</td>
                    <td>{{$score->execution_s}}</td>
                    <td>{{$score->deductions_s}}</td>
                    <td>{{$score->total_s}}</td>
                </tr>
            @endforeach
        </tbody>
      </table>

</div>
