<?php

namespace App\Livewire;

use App\Models\Note;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
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
        if ($this->archived) $states[] = true;
        if ($this->active) $states[] = false;
        if ($this->tag) {
            $builder = $this->tag->notes()->where('is_archived', 'in', $states);
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
