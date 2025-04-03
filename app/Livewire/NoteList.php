<?php

namespace App\Livewire;

use App\Models\Note;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class NoteList extends Component
{
    use WithPagination, WithoutUrlPagination;
    public ?Tag $tag = null;

    public int $perPage = 20;

    public bool $archived = false;
    public bool $active = true;

    public function mount(?Tag $tag, bool $active, bool $archived)
    {
        $this->tag = request()->route('tag');
        $this->archived = $archived;
        $this->active = $active;
    }

    #[Computed]
    public function notes()
    {
        $states = [];
        if ($this->archived)
            $states[] = true;
        if ($this->active)
            $states[] = false;
        if ($this->tag) {
            $builder = $this->tag->notes()->whereIn('is_archived', $states);
        } else {
            $builder = Auth::user()->notes()
                ->orderByDesc('last_edited_at')
                ->whereIn('is_archived', $states)
                ->with('tags');

            if ($searchTerm = request()->get('searchTerm')) {
                $builder->where(
                    fn($query) =>
                    $query->where('title', 'like', '%' . $searchTerm . '%')
                        ->orWhere('content', 'like', '%' . $searchTerm . '%')
                        ->orWhereHas('tags', fn($tagQuery) => 
                            $tagQuery->where('name', 'like', "%$searchTerm%")
                        )
                );
            }
        }
        $paginator = $builder->simplePaginate($this->perPage, page: 1);
        return $paginator;
    }

    public function updatingPage($page)
    {
        $this->perPage = $page * 20;
    }

    public function getNoteRoute(Note $note, ?Tag $tag, ?string $searchTerm): string
    {
        $routeName = Route::currentRouteName();
        $params = ['note' => $note, 'tag' => $tag];

        if ($note->id) {
            if (str_contains($routeName, 'archive')) {
                return route('archive.show', $params);
            } else if (str_contains($routeName, 'tag')) {
                return route('tag.note.show', $params);
            } else if (str_contains($routeName, 'search')) {
                if (filled($searchTerm)) {
                    $params['searchTerm'] = $searchTerm;
                }
                return route('search.note', $params);
            } else {
                return route('note.show', $params);
            }
        }
        return route('note.show', $params);
    }

    #[On('note-removed')]
    public function loadNextNote(int $id, bool $is_archived, bool $is_restored)
    {
        if ($is_restored) {
            Note::where(['id' => $id])->update(['is_archived' => false]);
        } else if ($is_archived) {
            Note::where(['id' => $id])->update(['is_archived' => true]);
        } else {
            Note::destroy($id);
        }
        unset($this->notes);
    }

    #[On('note-added')]
    public function reloadNotes()
    {
        unset($this->notes);
    }

    public function render()
    {
        return view('livewire.note-list', ['notes' => $this->notes]);
    }
}
