<x-gymLayout>
    <x-slot:title>
      Ver: {{$gimnasta->gametag}}
    </x-slot>
    <h1>{{$gimnasta->nombre_g}} - {{$gimnasta->gametag}}</h1>
    <div class='row'>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Details</h5>
                <!-- Default Table -->
                <table class="table">
                    <tbody>
                    <tr>
                        <th scope="row">Name</th>
                        <td>{{$gimnasta->nombre_g}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Gametag</th>
                        <td>{{$gimnasta->gametag}}</td>
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
                    <h5 class="card-title">Information</h5>
                    <ul>
                        <li>Kills: {{ number_format($playerStats->overall_kills) }}</li>
                        <li>Deaths: {{ number_format($playerStats->overall_deaths) }}</li>
                        <li>Assists: {{ number_format($playerStats->overall_assists) }}</li>
                        <li>ACS: {{ number_format($playerStats->acs_per_game, 2) }}</li>
                        <li>ADR: {{ number_format($playerStats->adr_per_game, 2) }}</li>
                        <li>K/D: {{ number_format($playerStats->kd_ratio, 2) }}</li>
                        <li>Average HS%: {{ number_format($playerStats->avg_hs * 100, 2) }}%</li>
                        <li>Average KAST%: {{ number_format($playerStats->avg_kast * 100, 2) }}%</li>
                        <li>FK per Game: {{ number_format($playerStats->fk_per_game, 2) }}</li>
                        <li>FD per Game: {{ number_format($playerStats->fd_per_game, 2) }}</li>
                        <li>Games Played: {{ $playerStats->games_played }}</li>
                        <li>Total Wins: {{ $playerStats->total_wins }}</li>
                    </ul>
                    @if(Auth::user()->is_admin == true)
                        <form action="{{ route('player.destroy', $gimnasta) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class='text-center'>
                                <a href="{{route('player.edit', $gimnasta)}}"><button type="button" class="btn btn-primary">Edit</button></a>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </form>
                    @endif
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