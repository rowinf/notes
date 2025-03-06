<?php

namespace App\Livewire\Notes;

use App\Livewire\Forms\NoteForm;
use App\Models\Note;
use App\Models\Tag;
use Date;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    public ?Tag $tag;
    public NoteForm $form;
    public $title = '';
    public $content = '';

    public function mount(Tag $tag, Note $note)
    {
        $this->tag = $tag;
        if ($note) {
            $this->form->setNote($note);
        }
    }

    #[Computed]
    public function notes()
    {
        if (request()->routeIs("tag")) {
            return $this->tag->notes;
        }
        $notes = Note::where([
            'is_archived' => request()->routeIs("archive"),
        ])->orderByDesc('last_edited_at')->get();

        if (request()->routeIs("dashboard.create")) {
            $notes->prepend(new Note);
        }
        return $notes;
    }

    public function save()
    {
        $note = $this->form->store();
        $this->redirect(route('dashboard.note', ['note' => $note]), navigate: true);
    }

    public function render()
    {
        return view('livewire.notes.index');
    }
}
