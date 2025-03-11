<?php

namespace App\Livewire\Notes;

use App\Livewire\Forms\NoteForm;
use App\Models\Note;
use App\Models\Tag;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;
    #[Url]
    public ?Note $note = null;
    #[Url]
    public ?Tag $tag = null;
    public NoteForm $form;
    public $perPage = 20;
    #[Url]
    public $searchTerm = '';

    public function updatingPage($page)
    {
        $this->perPage = $page * 20;
    }

    public function mount(Note $note)
    {
        $this->form->setNote($note);
    }

    #[Computed]
    public function notes()
    {
        if (request()->routeIs("tag.note")) {
            $builder = $this->tag->notes();
        } else {
            $builder = Note::where([
                'is_archived' => request()->routeIs("archive.note"),
            ])->orderByDesc('last_edited_at')->with('tags');
            if (filled($this->searchTerm)) {
                $builder
                    ->whereAny(['title', 'content'], 'like', '%' . $this->searchTerm . '%');
            }
        }
        $paginator = $builder->simplePaginate($this->perPage, page: 1);

        if (request()->routeIs("dashboard.create")) {
            $note = new Note;
            $paginator->prepend($note);
        }
        return $paginator;
    }

    public function save()
    {
        if ($this->form->note->id) {
            $this->note = $this->form->update();
        } else {
            $this->note = $this->form->store();
        }
        $this->redirect(route('dashboard.note', ['note' => $this->note]));
    }

    public function update()
    {
        $this->form->update();
    }

    public function delete()
    {
        $this->form->destroy();
        $this->redirect(route('dashboard.note', ['note' => $this->notes->first()]));
    }
    public function archive()
    {
        $this->form->archive();
        $this->redirect(route('dashboard.note', ['note' => $this->notes->first()]));
    }
    public function render()
    {
        return view('livewire.notes.index');
    }
}
