<?php

namespace App\Livewire\Forms;

use App\Models\Note;
use App\Models\Tag;
use Livewire\Form;

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
        $this->note = Note::create([
            'title' => $this->title,
            'content' => $this->content ?? '',
            'last_edited_at' => today(),
            'is_archived' => false,
            'user_id', auth()->id()
        ]);
        $this->updatedTags();
        return $this->note->fresh();
    }
    public function update()
    {
        $this->note->update([
            'title' => $this->title,
            'content' => $this->content,
            'last_edited_at' => today(),
            'is_archived' => false,
        ]);
        return $this->note->fresh();
    }

    public function updatedTags()
    {
        $tags = str($this->tags)
            ->explode(",")
            ->filter(fn($tag) => filled($tag))
            ->map(function ($tag) {
                return Tag::where('user_id', auth()->id())->firstOrCreate([
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
