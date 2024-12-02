<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\Round;
use App\Models\Score;
use App\Models\Aparato;
use Livewire\Component;

class AllScores extends Component
{
    public $eventsFilter;
    public $roundsFilter;
    public $aparatosFilter;
    
    public function render()
    {
        $scores= Score::query()
        ->when($this->roundsFilter, function($query){
            $query->where('rounds_id', $this->roundsFilter);
        })
        ->when($this->aparatosFilter, function($query){
            $query->where('aparatos_id', $this->aparatosFilter);
        })
        ->when($this->eventsFilter, function($query){
            $query->where('events_id', $this->eventsFilter);
        })
        ->where('approved', true)
        ->where('edited', false)
        ->with(['gimnastas', 'events', 'rounds', 'aparatos'])
        ->orderBy('events_id')
        ->orderBy('total_s', 'desc')
        ->orderBy('execution_s', 'desc')
        ->orderBy('difficulty_s', 'desc')
        ->get();
        
        $rounds = Round::all();
        $aparatos = Aparato::all();
        $events = Event::all();
        return view('livewire.all-scores', compact('scores', 'rounds', 'aparatos', 'events'));
    }
}
