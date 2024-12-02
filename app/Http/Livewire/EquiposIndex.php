<?php

namespace App\Http\Livewire;

use App\Models\Pais;
use App\Models\Event;
use App\Models\Equipo;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class EquiposIndex extends Component
{
    use WithPagination;
    
    public $paisesFilter;
    public $eventsFilter;
    public $displayEdit=false;
    public $equipo;
    public $equipo_id;
    public $paises_id;
    public $events_id;
 
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['reload' => 'render'];

    protected $rules = [
        'paises_id' => ['required', 'exists:paises,id'],
        'events_id' => ['required', 'exists:events,id'],
    ];

    public function edit(Equipo $equipo){
        $this->displayEdit = true;
        $this->equipo = $equipo;
        $this->equipo_id = $this->equipo->id;
        $this->paises_id=$this->equipo->paises_id;
        $this->events_id=$this->equipo->events_id;
    }

    public function update(){
        $this->validate();
        if($this->equipo->paises_id != $this->paises_id){ //Si el país del equipo cambió
            $deleted = DB::table('equipo_gimnasta')
            ->where('equipo_id', $this->equipo_id) //elimina las entradas de gimnastas en ese equipo
            ->delete();
        }
        Equipo::where("id", $this->equipo_id)->update([
            'paises_id' => $this->paises_id,
            'events_id' => $this->events_id,
        ]);

        $this->reset(['displayEdit', 'paises_id', 'events_id']);
        $this->emit('reload');
    }
    
    public function render()
    {
        $paises = Pais::orderBy('nombre_p')->get();
        $events = Event::all();
        $equipos = Equipo::query()
        ->when($this->paisesFilter, function($query){
            $query->where('paises_id', $this->paisesFilter);
        })
        ->when($this->eventsFilter, function($query){
            $query->where('events_id', $this->eventsFilter);
        })
        ->with(['paises', 'events'])
        ->paginate(7);
        return view('livewire.equipos-index', compact('equipos', 'paises', 'events'));
    }
}
