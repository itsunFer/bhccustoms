<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\Round;
use App\Models\Score;
use App\Models\Aparato;
use Livewire\Component;

class AllScores extends Component
{

    public $sortBy = 'gametag'; // Default column to sort by
    public $sortDirection = 'asc'; // Default sorting direction

    

    public function sortBy($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        // Construct the query with dynamic calculated columns

        $scores = Score::select(
            'gametag',
            \DB::raw('SUM(kills)/ COUNT(*) as kills_per_game'),
            \DB::raw('SUM(deaths)/ COUNT(*) as deaths_per_game'),
            \DB::raw('SUM(assists)/ COUNT(*) as assists_per_game'),
            \DB::raw('SUM(acs) / COUNT(*) as acs_per_game'),
            \DB::raw('SUM(adr) / COUNT(*) as adr_per_game'),
            \DB::raw('SUM(kills)/SUM(deaths) as kd_ratio'),
            \DB::raw('AVG(hs) as avg_hs'), // Assumes hs is stored as a decimal (e.g., 0.45 for 45%)
            \DB::raw('AVG(kast) as avg_kast'), // Assumes kast is stored as a decimal
            \DB::raw('SUM(fk) / COUNT(*) as fk_per_game'),
            \DB::raw('SUM(fd) / COUNT(*) as fd_per_game'),
            \DB::raw('COUNT(*) as games_played'),
            \DB::raw('SUM(CASE WHEN competencias.winners = scores.winloss THEN 1 ELSE 0 END) as total_wins'),
            \DB::raw('SUM(CASE WHEN competencias.winners = scores.winloss THEN 1 ELSE 0 END) / COUNT(*) as win_rate')
        )->join('competencias', 'scores.competencias_id', '=', 'competencias.id') // Assuming a match table exists
        ->groupBy('gametag')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->get();

        return view('livewire.all-scores', compact('scores'));
    }
}
