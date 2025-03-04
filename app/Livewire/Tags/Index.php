<?php

namespace App\Livewire\Tags;

use App\Models\Tag;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    #[Computed]
    public function tags()
    {
        return Tag::all();
    }

    public function render()
    {
        return view('livewire.tags.index');
    }
}
