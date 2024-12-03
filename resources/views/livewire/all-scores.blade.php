<div>
    <table class="table table-striped">
        <thead>
            <tr>
            <th wire:click="sortBy('gametag')">Player</th>
            <th wire:click="sortBy('win_rate')">Win Rate</th>
            <th wire:clicl="sortBy('total_wins')">Record</th>
            <th wire:click="sortBy('acs_per_game')">ACS/Game</th>
            <th wire:click="sortBy('kills_per_game')">K/G</th>
            <th wire:click="sortBy('deaths_per_game')">D/G</th>
            <th wire:click="sortBy('assists_per_game')">A/G</th>
            <th wire:click="sortBy('kd_ratio')">K/D</th>
            <th wire:click="sortBy('adr_per_game')">ADR/Game</th>
            <th wire:click="sortBy('avg_hs')">HS%</th>
            <th wire:click="sortBy('avg_kast')">KAST%</th>
            <th wire:click="sortBy('fk_per_game')">FK/Game</th>
            <th wire:click="sortBy('fd_per_game')">FD/Game</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($scores as $score)
            <tr>
                <td>{{ $score->gametag }}</td>
                <td>{{ number_format($score->win_rate * 100, 2) }}%</td>
                <td>{{ $score->total_wins}}-{{ $score->games_played - $score->total_wins}}</td>
                <td>{{ number_format($score->acs_per_game, 2) }}</td>
                <td>{{ number_format($score->kills_per_game, 2) }}</td>
                <td>{{ number_format($score->deaths_per_game, 2) }}</td>
                <td>{{ number_format($score->assists_per_game, 2) }}</td>
                <td>{{ number_format($score->kd_ratio, 2) }}</td>
                <td>{{ number_format($score->adr_per_game, 2) }}</td>
                <td>{{ number_format($score->avg_hs * 100, 2) }}%</td>
                <td>{{ number_format($score->avg_kast * 100, 2) }}%</td>
                <td>{{ number_format($score->fk_per_game, 2) }}</td>
                <td>{{ number_format($score->fd_per_game, 2) }}</td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
