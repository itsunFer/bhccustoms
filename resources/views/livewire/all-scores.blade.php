<div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" wire:click="sort('gametag')">
                    Player
                    @if($sortBy == 'gametag') 
                        @if($sortDirection == 'asc') 🔼 @else 🔽 @endif
                    @endif
                </th>
                <th scope="col" wire:click="sort('acs')">
                    ACS
                    @if($sortBy == 'acs') 
                        @if($sortDirection == 'asc') 🔼 @else 🔽 @endif
                    @endif
                </th>
                <th scope="col" wire:click="sort('kills')">
                    K
                    @if($sortBy == 'kills') 
                        @if($sortDirection == 'asc') 🔼 @else 🔽 @endif
                    @endif
                </th>
                <th scope="col" wire:click="sort('deaths')">
                    D
                    @if($sortBy == 'deaths') 
                        @if($sortDirection == 'asc') 🔼 @else 🔽 @endif
                    @endif
                </th>
                <th scope="col" wire:click="sort('assists')">
                    A
                    @if($sortBy == 'assists') 
                        @if($sortDirection == 'asc') 🔼 @else 🔽 @endif
                    @endif
                </th>
                <th scope="col" wire:click="sort('kills_deaths_difference')">
                    +/-
                    @if($sortBy == 'kills_deaths_difference') 
                        @if($sortDirection == 'asc') 🔼 @else 🔽 @endif
                    @endif
                </th>
                <th scope="col" wire:click="sort('kd_ratio')">
                    K/D
                    @if($sortBy == 'kd_ratio') 
                        @if($sortDirection == 'asc') 🔼 @else 🔽 @endif
                    @endif
                </th>

                <th scope="col" wire:click="sort('adr')">
                    ADR
                    @if($sortBy == 'adr') 
                        @if($sortDirection == 'asc') 🔼 @else 🔽 @endif
                    @endif
                </th>
                <th scope="col" wire:click="sort('hs')">
                    HS%
                    @if($sortBy == 'hs') 
                        @if($sortDirection == 'asc') 🔼 @else 🔽 @endif
                    @endif
                </th>
                <th scope="col" wire:click="sort('kast')">
                    KAST
                    @if($sortBy == 'kast') 
                        @if($sortDirection == 'asc') 🔼 @else 🔽 @endif
                    @endif
                </th>
                <th scope="col" wire:click="sort('fk')">
                    FK
                    @if($sortBy == 'fk') 
                        @if($sortDirection == 'asc') 🔼 @else 🔽 @endif
                    @endif
                </th>
                <th scope="col" wire:click="sort('fd')">
                    FD
                    @if($sortBy == 'fd') 
                        @if($sortDirection == 'asc') 🔼 @else 🔽 @endif
                    @endif
                </th>
                <th scope="col" wire:click="sort('rank')">
                    Rank
                    @if($sortBy == 'rank') 
                        @if($sortDirection == 'asc') 🔼 @else 🔽 @endif
                    @endif
                </th>
                <th scope="col" wire:click="sort('plants')">
                    Plants
                    @if($sortBy == 'plants') 
                        @if($sortDirection == 'asc') 🔼 @else 🔽 @endif
                    @endif
                </th>
                <th scope="col" wire:click="sort('defuses')">
                    Defuses
                    @if($sortBy == 'defuses') 
                        @if($sortDirection == 'asc') 🔼 @else 🔽 @endif
                    @endif
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($scores as $score)
                <tr>
                    <td>{{ $score->gametag }}</td>
                    <td>{{ $score->acs }}</td>
                    <td>{{ $score->kills }}</td>
                    <td>{{ $score->deaths }}</td>
                    <td>{{ $score->assists }}</td>
                    <td>{{ $score->kills - $score->deaths }}</td>
                    <td>{{ number_format($score->kills / max($score->deaths, 1), 2) }}</td>
                    <td>{{ $score->adr }}</td>
                    <td>{{ number_format($score->hs * 100, 2) }}%</td>
                    <td>{{ number_format($score->kast * 100, 2) }}%</td>
                    <td>{{ $score->fk }}</td>
                    <td>{{ $score->fd }}</td>
                    <td>{{ $score->rank }}</td>
                    <td>{{ $score->plants }}</td>
                    <td>{{ $score->defuses }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
