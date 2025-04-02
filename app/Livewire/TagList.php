<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.tags')]
class TagList extends Component
{
    public function render()
    {
        return view('livewire.tag-list');
    }
}
