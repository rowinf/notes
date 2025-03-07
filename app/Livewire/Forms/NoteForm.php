<?php

namespace App\Livewire\Forms;

use App\Models\Note;
use Date;
use Livewire\Attributes\Validate;
use Livewire\Form;

class NoteForm extends Form
{

    public ?Note $note;
    public $title = '';
    public $content = '';

    public function store()
    {
        return Note::create([
            'title' => $this->title,
            'content' => $this->content ?? '',
            'last_edited_at' => Date::now(),
            'is_archived' => false,
        ]);
    }
    public function update()
    {
        return $this->note->update([
            'title' => $this->title,
            'content' => $this->content,
            'last_edited_at' => Date::now(),
            'is_archived' => false,
        ]);
    }

    public function destroy()
    {
        return $this->note->delete();
    }

    public function archive()
    {
        return $this->note->update([
            'is_archived' => true,
        ]);
    }


    public function setNote(Note $note)
    {
        $this->title = $note->title;
        $this->content = $note->content;
        $this->note = $note;
    }

}
