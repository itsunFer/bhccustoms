<?php

namespace App\Http\Livewire;

use App\Models\Pais;
use App\Models\Event;
use App\Models\Equipo;
use Livewire\Component;

class InsertEquipo extends Component
{
    public $paises_id;
    public $events_id;
    public $display=false;
    

    protected $rules = [
        'paises_id' => ['required', 'exists:paises,id'],
        'events_id' => ['required', 'exists:events,id'],
    ];

    public function save(){
        $this->validate();

        Equipo::create([
            'paises_id' => $this->paises_id,
            'events_id' => $this->events_id,
        ]);

        $this->reset(['display', 'paises_id', 'events_id']);
        $this->emit('reload');
    }


    public function render()
    {
        $paises = Pais::orderBy('nombre_p')->get();
        $events = Event::all();
        return view('livewire.insert-equipo', compact('paises', 'events'));
    }
}
