<?php

namespace App\Livewire\Forms;

use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Livewire\Form;
use Date;
use Str;

class NoteForm extends Form
{

    public ?Note $note;

    public string $title = 'Untitled Note';
    public string $content = '';
    public string $tags = '';
    public ?string $last_edited_at = null;
    public ?bool $is_archived = false;

    public function save()
    {
        if ($this->note->id) {
            return $this->update();
        }
        return $this->store();
    }

    public function store()
    {
        $this->note = Auth::user()->notes()->create([
            'title' => $this->title,
            'content' => $this->content ?? '',
            'last_edited_at' => Date::now(),
            'is_archived' => false,
        ]);
        $this->updatedTags();
        return $this->note->fresh();
    }
    public function update()
    {
        $this->note->update([
            'title' => $this->title,
            'content' => $this->content,
            'last_edited_at' => Date::now(),
            'is_archived' => false,
        ]);
        return $this->note->fresh();
    }

    public function updatedTags()
    {
        $tags = Str::of($this->tags)
            ->explode(",")
            ->filter(fn($tag) => filled($tag))
            ->map(function ($tag) {
                return Auth::user()->tags()->firstOrCreate([
                    'name' => $tag,
                ])->id;
            });
        return $this->note->tags()->sync($tags);
    }

    public function setNote(Note $note)
    {
        $this->title = $note->title;
        if ($note->content) {
            $this->content = $note->content;
        }
        $this->is_archived = $note->is_archived;
        $this->note = $note;
        if ($note->last_edited_at) {
            $this->last_edited_at = $note->last_edited_at;
        }
        $this->tags = $note->tags->map(function ($tag) {
            return $tag->name;
        })->join(',');
    }
}
