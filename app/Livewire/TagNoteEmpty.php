<?php

namespace App\Livewire;

use App\Models\Tag;
use Livewire\Component;

class TagNoteEmpty extends Component
{
    public Tag $tag;
    public function render()
    {
        return view('livewire.tag-note-empty');
    }
}
