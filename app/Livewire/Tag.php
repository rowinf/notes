<?php

namespace App\Livewire;

use Livewire\Component;

class Tag extends Component
{
    public function mount(\App\Models\Tag $tag)
    {
        $r = route('tag.note', [
            'tag' => $tag,
            'note' => $tag->notes->first()
        ]);
        $this->redirect($r);
    }
}
