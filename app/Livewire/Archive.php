<?php

namespace App\Livewire;

use App\Models\Note;
use Livewire\Component;

class Archive extends Component
{
    public function mount()
    {
        $r = route('archive.note', [
            'note' => Note::orderByDesc('last_edited_at')->where(['is_archived' => true])->first()
        ]);
        $this->redirect($r);
    }
}
