<?php

namespace App\Http\Livewire;

use App\Models\News;
use Livewire\Component;

class NewsIndex extends Component
{
    
    public $titleFilter;

    public function render()
    {
        $news = News::query()
        ->when($this->titleFilter, function($query){
            $query->where('title', 'like', '%' . $this->titleFilter . '%');
        })->get();
        return view('livewire.news-index', compact('news'));
    }
}
