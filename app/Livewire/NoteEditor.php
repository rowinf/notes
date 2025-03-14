<?php

namespace App\Livewire;

use App\Livewire\Forms\NoteForm;
use App\Models\Note;
use App\Models\Tag;
use Livewire\Component;

class NoteEditor extends Component
{
    public NoteForm $form;
    public ?Tag $tag = null;

    public function mount(?Note $note, ?Tag $tag): void
    {
        $this->tag = $tag;
        if ($note) {
            $this->form->setNote($note);
        } else if (request()->routeIs("note.create")) {
            $this->form->setNote(new Note);
        }
    }

    public function save()
    {
        if ($this->form->note->id) {
            $this->note = $this->form->update();
        } else {
            $this->note = $this->form->store();
        }
        $this->redirect(route('note.show', ['note' => $this->note]));
    }

    public function update()
    {
        $this->form->update();
    }

    public function delete()
    {
        $this->form->destroy();
        $this->redirect(route('note.show', ['note' => $this->notes->first()]));
    }
    public function archive()
    {
        $this->form->archive();
        $this->redirect(route('note.show', ['note' => $this->notes->first()]));
    }
    public function render()
    {
        return view('livewire.note-editor');
    }
}
