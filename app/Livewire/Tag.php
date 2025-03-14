<?php

namespace App\Livewire;

use Livewire\Component;

class Tag extends Component
{
    public function mount(\App\Models\Tag $tag)
    {
        $this->redirect(route('tag.index', ['tag'=> $tag]));
    }
}
