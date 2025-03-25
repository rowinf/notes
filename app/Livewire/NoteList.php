<?php

namespace App\Livewire;

use App\Models\Note;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class NoteList extends Component
{
    use WithPagination, WithoutUrlPagination;
    public ?Tag $tag = null;
    #[Url]
    public $searchTerm = '';

    public $perPage = 20;

    public function mount(?Tag $tag)
    {
        $this->tag = request()->route('tag');
    }

    #[Computed]
    public function notes()
    {
        if ($this->tag) {
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

    public function updatingPage($page)
    {
        $this->perPage = $page * 20;
    }

    #[On('note-removed')]
    public function loadNextNote(Note $note, bool $is_archived)
    {
        if ($is_archived) {
            $note->update(['is_archived' => true]);
        } else {
            $note->delete();
        }
        unset($this->notes);
    }

    public function render()
    {
        return view('livewire.note-list', ['notes' => $this->notes]);
    }
}
