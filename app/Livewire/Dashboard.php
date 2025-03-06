<?php

namespace App\Livewire;

use App\Models\Note;
use Livewire\Component;

class Dashboard extends Component
{

    public function mount()
    {
        $r = route('dashboard.note', [
            'note' => Note::orderByDesc('last_edited_at')->where(['is_archived' => false])->first()
        ]);
        $this->redirect($r);
    }
}
