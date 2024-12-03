<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\Round;
use App\Models\Score;
use App\Models\Aparato;
use Livewire\Component;

class AllScores extends Component
{

    public $sortBy = 'acs'; // Default column to sort by
    public $sortDirection = 'asc'; // Default sorting direction

    public function sort($column)
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
        $scores = Score::query()
            ->select([
                'scores.*',
                \DB::raw('scores.kills - scores.deaths as kills_deaths_difference'),
                \DB::raw('IF(scores.deaths = 0, scores.kills, scores.kills / scores.deaths) as kd_ratio') // Handle divide by zero
            ])
            ->orderBy($this->sortBy, $this->sortDirection)
            ->get();

        return view('livewire.all-scores', compact('scores'));
    }
}
