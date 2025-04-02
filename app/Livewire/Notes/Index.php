<?php

namespace App\Livewire\Notes;

use App\Livewire\Forms\NoteForm;
use App\Models\Note;
use App\Models\Tag;
use Livewire\Component;

class Index extends Component
{
    public NoteForm $form;
    public ?Note $note = null;
    public ?Tag $tag = null;
    public ?string $searchTerm = '';

    public function mount(?Note $note, ?Tag $tag)
    {
        $this->tag = $tag;
        $this->note = $note;
        $this->searchTerm = request()->get('searchTerm');
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
            $this->dispatch('note-added', id: $note->id, message: 'Note saved successfully!');
        }
    }

    public function updated()
    {
        if ($this->form->note->id) {
            $updates = $this->form->updatedTags();
            if (count($updates['attached'])) {
                $this->dispatch('toast', message: "Tags added successfully!");
            } else if (count($updates['detached'])) {
                $this->dispatch('toast', message: "Tags removed successfully!");
            }
        }
    }

    public function delete()
    {
        $this->dispatch('note-removed', id: $this->note->id, is_archived: $this->note->is_archived, is_restored: false, message: 'Note permanently deleted.');
        if ($this->note->is_archived) {
            $this->redirect(route('archive.index'), navigate: true);
        } else {
            $this->redirect(route('note.index'), navigate: true);
        }
    }
    public function archive()
    {
        $this->dispatch('note-removed', id: $this->note->id, is_archived: true, is_restored: false, message: 'Note archived.', link: 'archive.index');
        $this->redirect(route('note.index'), navigate: true);
    }

    public function restoreNote()
    {
        $this->dispatch('note-removed', id: $this->note->id, is_archived: false, is_restored: true, message: 'Note restored to active notes.', link: 'note.index');
        $this->redirect(route('archive.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.notes.index');
    }
}
