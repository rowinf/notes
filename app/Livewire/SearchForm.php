<?php

namespace App\Livewire;

use Livewire\Component;

class SearchForm extends Component
{    
    public String $searchTerm;

    public function submit() {
        $this->redirect(route("search.index", ["searchTerm"=> $this->searchTerm]));
    }
    public function render()
    {
        return view('livewire.search-form');
    }
}
