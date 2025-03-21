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
        if (request()->routeIs("note.create")) {
            $this->form->setNote(new Note(['content' => '']));
        } else {
            $this->form->setNote($note);
        }
    }

    public function update()
    {
        $note = $this->form->save();
        if (request()->routeIs("note.create")) {
            $this->dispatch('note-saved', message: 'Note created!');
            $this->redirect(route('note.show', ['note' => $note]), navigate: true);
        } else {
            $this->dispatch('note-saved', message: 'Note saved successfully!');
        }
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
