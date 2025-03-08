<?php

namespace App\Livewire\Notes;

use App\Livewire\Forms\NoteForm;
use App\Models\Note;
use App\Models\Tag;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination; 
    public ?Tag $tag;
    public NoteForm $form;
    public $title = '';
    public $content = '';
    public $perPage = 20;

    public function updatingPage($page)
    {
        $this->perPage = $page * 20;
    }

    public function mount(?Tag $tag, Note $note)
    {
        $this->tag = $tag;
        $this->form->setNote($note);
    }

    #[Computed]
    public function notes()
    {
        if (request()->routeIs("tag.note")) {
            return $this->tag->notes()->simplePaginate($this->perPage, page: 1);
        }
        $notes = Note::where([
            'is_archived' => request()->routeIs("archive.note"),
        ])->orderByDesc('last_edited_at')->simplePaginate($this->perPage, page: 1);

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

    public function delete()
    {
        $this->form->destroy();
        $this->redirect(route('dashboard.note', ['note' => $this->notes->first()]), navigate: true);
    }
    public function archive()
    {
        $this->form->archive();
        $this->redirect(route('dashboard.note', ['note' => $this->notes->first()]), navigate: true);
    }
    public function render()
    {
        return view('livewire.notes.index');
    }
}
