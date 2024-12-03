<?php

namespace App\Http\Livewire;

use App\Models\Competencia;
use App\Models\Gimnasta;
use App\Models\Score;
use Livewire\Component;

class IndexScores extends Component
{
    public $gimnastaFilter;

    public function render()
    {
        $scores= Score::query()
        ->when($this->gimnastaFilter, function($query){
            $query->where('gametag', $this->gimnastaFilter);
        })
        ->with(['gimnastas'])
        ->where('approved', true)
        ->get();
        
        $gimnasta = Gimnasta::all();
        return view('livewire.index-scores', compact('scores', 'gimnasta'));
    }
}
