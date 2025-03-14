<?php

namespace App\Livewire;

use App\Models\Tag;
use Livewire\Component;

class NoteEmpty extends Component
{
    public ?Tag $tag = null;
    public function render()
    {
        return view('livewire.note-empty');
    }
}
