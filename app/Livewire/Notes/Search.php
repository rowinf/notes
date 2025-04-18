<?php

namespace App\Livewire\Notes;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout('components.layouts.search')]
class Search extends Component
{
    public String $searchTerm;

    public function submit() {
        $this->redirect(route("search.index", ["searchTerm"=> $this->searchTerm]));
    }

    public function render()
    {
        return view('livewire.notes.search');
    }
}
