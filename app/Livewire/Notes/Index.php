<?php

namespace App\Livewire\Notes;

use App\Models\Note;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    public bool $is_archived;

    #[Computed]
    public function note(String $id) {
        return $id;
    }

    #[Computed]
    public function notes() {
        return Note::where(['is_archived'=>request()->routeIs("archive")])->get();
    }
    public function render()
    {
        return view('livewire.notes.index');
    }
}
