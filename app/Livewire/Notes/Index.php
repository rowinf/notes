<?php

namespace App\Livewire\Notes;

use App\Models\Note;
use App\Models\Tag;
use Date;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    public bool $is_archived;
    public ?Tag $tag;

    public $title = '';
    public $content = '';

    public function mount(Tag $tag)
    {
        $this->tag = $tag;
    }

    #[Computed]
    public function notes()
    {
        if (request()->routeIs("tag")) {
            return $this->tag->notes;
        }
        return Note::where([
            'is_archived' => request()->routeIs("archive"),
        ])->orderByDesc('last_edited_at')->get();
    }

    public function save()
    {
        Note::create([
            'title' => $this->title,
            'content' => $this->content,
            'last_edited_at' => Date::now(),
            'is_archived' => false,
        ]);
        $this->redirect("/dashboard", navigate: true);
    }

    public function render()
    {
        return view('livewire.notes.index');
    }
}
