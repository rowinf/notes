<?php

namespace App\Livewire;

use App\Livewire\Notes\Index;
use Livewire\Component;

class Archive extends Component
{
    public function mount()
    {
        $this->redirect(route('archive.index'));
    }
}
