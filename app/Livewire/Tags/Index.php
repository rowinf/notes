<?php

namespace App\Livewire\Tags;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    #[Computed]
    public function tags()
    {
        return Auth::user()->tags;
    }

    public function render()
    {
        return view('livewire.tags.index');
    }
}
