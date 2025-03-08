<?php

namespace App\Livewire\Notes;

use Livewire\Attributes\Url;
use Livewire\Component;

class Search extends Component
{
    #[Url]
    public String $searchTerm;

    public function submitSearch() {
        $this->redirect(route("dashboard.note", ["searchTerm"=> $this->searchTerm]));
    }

    public function render()
    {
        return view('livewire.notes.search');
    }
}
