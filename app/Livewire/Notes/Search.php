<?php

namespace App\Livewire\Notes;

use Livewire\Attributes\Url;
use Livewire\Component;

class Search extends Component
{
    public String $searchTerm;

    public function submit() {
        $this->redirect(route("note.index", ["searchTerm"=> $this->searchTerm]));
    }

    public function render()
    {
        return view('livewire.notes.search');
    }
}
