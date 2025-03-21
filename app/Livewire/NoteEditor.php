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
        if ($this->form->note->id) {
            $note = $this->form->save();
            $this->dispatch('toast', message: 'Note saved successfully!');
        } else {
            $note = $this->form->save();
            $this->redirect(route('note.show', ['note' => $note, 'event' => 'note-created']), navigate: true);
        }
    }

    public function updated()
    {
        $updates = $this->form->updatedTags();
        if (count($updates['attached'])) {
            $this->dispatch('toast', message: "Tags successfully added");
        } else if (count($updates['detached'])) {
            $this->dispatch('toast', message: "Tags successfully removed");
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
