<?php

namespace App\Livewire\Notes;

use App\Livewire\Forms\NoteForm;
use App\Models\Note;
use App\Models\Tag;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    public ?Tag $tag;
    public NoteForm $form;
    public $title = '';
    public $content = '';

    public function mount(?Tag $tag, Note $note)
    {
        $this->tag = $tag;
        $this->form->setNote($note);
    }

    #[Computed]
    public function notes()
    {
        if (request()->routeIs("tag.note")) {
            return $this->tag->notes;
        }
        $notes = Note::where([
            'is_archived' => request()->routeIs("archive.note"),
        ])->orderByDesc('last_edited_at')->get();

        if (request()->routeIs("dashboard.create")) {
            $note = new Note;
            $notes->prepend($note);
        }
        return $notes;
    }

    public function save()
    {
        if ($this->form->note->id) {
            $this->form->update();
        } else {
            $note = $this->form->store();
            $this->redirect(route('dashboard.note', ['note' => $note]), navigate: true);
        }
    }

    public function update()
    {
        $this->form->update();
    }
    public function render()
    {
        return view('livewire.notes.index');
    }
}
