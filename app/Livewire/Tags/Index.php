<?php

namespace App\Livewire\Tags;

use App\Models\Tag;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.tags.index')->with([
            'tags' => Tag::orderByDesc('created_at')->where('user_id', auth()->id())->get()
        ]);
    }
}
