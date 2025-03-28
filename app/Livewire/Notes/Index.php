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
        $this->dispatch('note-removed', id: $this->note->id, is_archived: false, is_restored: false, message: 'Note permanently deleted.');
    }
    public function archive()
    {
        $this->dispatch('note-removed', id: $this->note->id, is_archived: true, is_restored: false, message: 'Note archived.', link: 'archive.index');
    }

    public function restore()
    {
        $this->dispatch('note-removed', id: $this->note->id, is_archived: false, is_restored: true, message: 'Note restored to active notes.', link: 'note.index');
    }

    public function render()
    {
        return view('livewire.notes.index');
    }
}
