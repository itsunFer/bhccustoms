<?php

namespace App\Http\Livewire;

use App\Models\Forum;
use App\Models\Tag;
use Livewire\Component;

class ForumsIndex extends Component
{

    public $titleFilter;
    public $authorFilter;
    public $selectedTag;
    

    public function render()
    {
        $tags = Tag::all();

        $forums = Forum::query()
        ->when($this->titleFilter, function($query){
            $query->where('title', 'like', '%' . $this->titleFilter . '%');
        })->when($this->authorFilter, function ($query) {
            $query->whereHas('author', function ($subQuery) {
                $subQuery->where('name', 'like', '%' . $this->authorFilter . '%');
            });
        })
        ->when($this->selectedTag, function ($query) {
            $query->whereHas('tags', function ($subQuery) {
                $subQuery->where('id', $this->selectedTag);
            });
        })
        ->with('tags')
        ->get();
        return view('livewire.forums-index', compact('forums', 'tags'));
    }
}
