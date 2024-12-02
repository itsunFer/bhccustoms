<?php

namespace App\Http\Livewire;

use App\Models\Pais;
use Livewire\Component;
use App\Models\Gimnasta;
use Livewire\WithPagination;



class IndexGimnasta extends Component
{

    use WithPagination;

    public $paisesFilter;
    public $nombreFilter;
    public $display=false;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $paises = Pais::orderBy('nombre_p')->get();
        $gimnastas = Gimnasta::query()
        ->when($this->paisesFilter, function($query){
            $query->where('paises_id', $this->paisesFilter);
        })
        ->when($this->nombreFilter, function($query){
            $query->where('nombre_g', 'like', '%' . $this->nombreFilter . '%');
        })
        ->with('paises')
        ->orderBy("paises_id")
        ->paginate(9);
        return view('livewire.index-gimnasta', compact('paises', 'gimnastas'));
    }
}
