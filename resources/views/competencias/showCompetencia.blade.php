<x-gymLayout>
    <x-slot:title>
        {{$competencia->map}}
    </x-slot>
    <h1>{{$competencia->map}} {{$competencia->score}}</h1>
    
    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Player</th>
            <th scope="col">ACS</th>
            <th scope="col">K</th>
            <th scope="col">D</th>
            <th scope="col">A</th>
            <th scope="col">+/-</th>
            <th scope="col">K/D</th>
            <th scope="col">ADR</th>
            <th scope="col">HS%</th>
            <th scope="col">KAST</th>
            <th scope="col">FK</th>
            <th scope="col">FD</th>
            <th scope="col">Rank</th>
            <th scope="col">Plants</th>
            <th scope="col">Defuses</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($scores as $score)
            @if ($score->winloss==0)
                <tr>
                    <td>{{$score->gametag}}</td>
                    <td>{{$score->acs}}</td>
                    <td>{{$score->kills}}</td>
                    <td>{{$score->deaths}}</td>
                    <td>{{$score->assists}}</td>
                    <td>{{$score->kills - $score->deaths}}</td>
                    <td>{{number_format($score->kills / $score->deaths,2)}}</td>
                    <td>{{$score->adr}}</td>
                    <td>{{number_format($score->hs*100,2)}}%</td>
                    <td>{{number_format($score->kast*100,2)}}%</td>
                    <td>{{$score->fk}}</td>
                    <td>{{$score->fd}}</td>
                    <td>{{$score->rank}}</td>
                    <td>{{$score->plants}}</td>
                    <td>{{$score->defuses}}</td>
                    <td class='text-center'></td>  
                </tr>
            @endif
          @endforeach
                <tr><td></td></tr>
          @foreach ($scores as $score)
            @if ($score->winloss==1)
                <tr>
                    <td>{{$score->gametag}}</td>
                    <td>{{$score->acs}}</td>
                    <td>{{$score->kills}}</td>
                    <td>{{$score->deaths}}</td>
                    <td>{{$score->assists}}</td>
                    <td>{{$score->kills - $score->deaths}}</td>
                    <td>{{number_format($score->kills / $score->deaths,2)}}</td>
                    <td>{{$score->adr}}</td>
                    <td>{{number_format($score->hs*100,2)}}%</td>
                    <td>{{number_format($score->kast*100,2)}}%</td>
                    <td>{{$score->fk}}</td>
                    <td>{{$score->fd}}</td>
                    <td>{{$score->rank}}</td>
                    <td>{{$score->plants}}</td>
                    <td>{{$score->defuses}}</td>
                    <td class='text-center'></td>  
                </tr>
            @endif
          @endforeach
          
        </tbody>
        @if(Auth::user()->is_admin == true)
            <tr>
                <td><a href="{{route('score.create', $competencia->id)}}">
                    <i class="bi bi-clipboard-plus"></i>
                    <span>New Score</span>
                </a></td>
            </tr>
            <tr>
              <td>
                <form action="{{ route('csv.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="csv_file">Upload CSV File:</label>
                <input type="file" name="csv_file" id="csv_file" required>
                <button type="submit">Upload</button>
                </form>
              </td>
            </tr>
          @endif
      </table>

    <x/slot>
</x-gymLayout>