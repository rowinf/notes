<?php

namespace App\Livewire\Notes;

use App\Models\Note;
use App\Models\Tag;
use Livewire\Component;

class Index extends Component
{
    public ?Note $note = null;
    public ?Tag $tag = null;
    public $perPage = 20;

    public function updatingPage($page)
    {
        $this->perPage = $page * 20;
    }

    public function mount(?Note $note, ?Tag $tag)
    {
        $this->tag = $tag;
        $this->note = $note;
    }

    public function delete()
    {
        $this->dispatch('note-removed', note: $this->note, is_archived: false);
    }
    public function archive()
    {
        $this->dispatch('note-removed', note: $this->note, is_archived: true);
    }

    public function render()
    {
        return view('livewire.notes.index');
    }
}
