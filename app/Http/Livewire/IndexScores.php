<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\Round;
use App\Models\Score;
use App\Models\Aparato;
use Livewire\Component;

class IndexScores extends Component
{
    public $event;
    public $roundsFilter;
    public $aparatosFilter;

    public function mount($event)
    {
        $this->event = $event;
    }
    public function render()
    {
        $scores= Score::query()
        ->when($this->roundsFilter, function($query){
            $query->where('rounds_id', $this->roundsFilter);
        })
        ->when($this->aparatosFilter, function($query){
            $query->where('aparatos_id', $this->aparatosFilter);
        })
        ->with(['gimnastas', 'events', 'rounds', 'aparatos'])
        ->where('events_id', $this->event)
        ->where('approved', true)
        ->orderBy('total_s', 'desc')
        ->orderBy('execution_s', 'desc')
        ->orderBy('difficulty_s', 'desc')
        ->get();
        
        $rounds = Round::all();
        $aparatos = Aparato::all();
        return view('livewire.index-scores', compact('scores', 'rounds', 'aparatos'));
    }
}
