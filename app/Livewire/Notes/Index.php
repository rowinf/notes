<?php

namespace App\Livewire\Notes;

use Illuminate\Support\Facades\Auth;
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
    public ?Tag $tag = null;
    public NoteForm $form;
    public $perPage = 20;
    #[Url]
    public $searchTerm = '';

    public function updatingPage($page)
    {
        $this->perPage = $page * 20;
    }

    public function mount(?Note $note, ?Tag $tag)
    {
        $this->tag = $tag;
        if ($note) {
            $this->form->setNote($note);
        } else if (request()->routeIs("note.create")) {
            $this->form->setNote(new Note);
        }
    }

    #[Computed]
    public function notes()
    {
        if (request()->routeIs("tag.note")) {
            $builder = $this->tag->notes()->where(['is_archived' => false]);
        } else {
            $builder = Auth::user()->notes()->where([
                'is_archived' => request()->routeIs('archive.index', 'archive.show'),
            ])->orderByDesc('last_edited_at')->with('tags');
            if (filled($this->searchTerm)) {
                $builder
                    ->whereAny(['title', 'content'], 'like', '%' . $this->searchTerm . '%');
            }
        }
        $paginator = $builder->simplePaginate($this->perPage, page: 1);
        return $paginator;
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
        return view('livewire.notes.index');
    }
}
