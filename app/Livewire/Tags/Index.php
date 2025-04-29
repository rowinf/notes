<?php

namespace App\Livewire\Tags;

use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.tags.index')->with([
            'id' => auth()->id(),
            'tags' => Tag::orderByDesc('created_at')->where('user_id', auth()->id())->get()
        ]);
    }
}
