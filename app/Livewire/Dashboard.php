<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{

    public function mount()
    {
        $this->redirect(route('note.index'));
    }
}
