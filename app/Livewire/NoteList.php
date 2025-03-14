<?php

namespace App\Livewire;

use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithoutUrlPagination;

class NoteList extends Component
{
    use WithoutUrlPagination;
    public ?Tag $tag = null;
    #[Url]
    public $searchTerm = '';

    public $perPage = 20;

    public function mount(?Tag $tag)
    {
        $this->tag = request()->route('tag');
    }

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

    public function render()
    {
        return view('livewire.note-list', ['notes' => $this->notes()]);
    }
}
