<?php

namespace App\Livewire\Notes;

use App\Models\Note;
use App\Models\Tag;
use Livewire\Attributes\Url;
use Livewire\Component;

class Index extends Component
{
    public ?Note $note = null;
    public ?Tag $tag = null;
    public $perPage = 20;
    #[Url]
    public $searchTerm = '';

    public function updatingPage($page)
    {
        $this->perPage = $page * 20;
    }

    public function mount(?Note $note, ?Tag $tag)
    {
        $this->tag = $tag;
        $this->note = $note;
    }

    public function render()
    {
        return view('livewire.notes.index');
    }
}
