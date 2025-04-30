<?php

namespace App\Livewire;

use App\Models\Tag;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.tags')]
class TagList extends Component
{
    public function render()
    {
        return view('livewire.tag-list')->with([
            'tags' => Tag::orderByDesc('created_at')->whereRelation('notes', 'user_id', '=', auth()->id())->get()
        ]);
    }
}
