<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\changeScore;
use Livewire\WithPagination;

class ChangeScores extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $scores = changeScore::with('scores')
        ->paginate(1);
        
        return view('livewire.change-scores', compact('scores'));
    }
}
