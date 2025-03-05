<?php

namespace App\Livewire\Notes;

use App\Models\Note;
use App\Models\Tag;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    public bool $is_archived;
    public Tag $tag;
    
    public function mount(Tag $tag) 
    {
        $this->tag = $tag;
    }

    #[Computed]
    public function notes()
    {
        if (request()->routeIs("tag")) {
            return $this->tag->notes;
        }
        return Note::where([
            'is_archived' => request()->routeIs("archive"),
        ])->get();
    }

    public function render()
    {
        return view('livewire.notes.index');
    }
}
