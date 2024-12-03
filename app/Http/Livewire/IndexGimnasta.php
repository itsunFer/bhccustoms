<?php

namespace App\Http\Livewire;

use App\Models\Pais;
use Livewire\Component;
use App\Models\Gimnasta;
use Livewire\WithPagination;



class IndexGimnasta extends Component
{

    use WithPagination;

    public $nombreFilter;
    public $display=false;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $gimnastas = Gimnasta::query()
        ->when($this->nombreFilter, function($query){
            $query->where('nombre_g', 'like', '%' . $this->nombreFilter . '%');
        })
        ->orderBy("nombre_g")
        ->paginate(9);
        return view('livewire.index-gimnasta', compact('gimnastas'));
    }
}
