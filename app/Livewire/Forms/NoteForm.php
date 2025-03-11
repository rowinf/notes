<?php

namespace App\Livewire\Forms;

use App\Models\Tag;
use App\Models\Note;
use Date;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Str;

class NoteForm extends Form
{

    public ?Note $note;
    public string $title = '';
    public $content = '';
    public string $tags;

    public function store()
    {
        $this->note = Note::create([
            'title' => $this->title,
            'content' => $this->content ?? '',
            'last_edited_at' => Date::now(),
            'is_archived' => false,
        ]);
        $this->syncTags();
        return $this->note;
    }
    public function update()
    {
        $this->note->update([
            'title' => $this->title,
            'content' => $this->content,
            'last_edited_at' => Date::now(),
            'is_archived' => false,
        ]);
        $this->syncTags();
        return $this->note;
    }

    public function syncTags() {
        $tags = Str::of($this->tags)
            ->explode(",")
            ->map(function ($tag) {
                return Tag::firstOrCreate([
                    'name' => $tag,
                ])->id;
            });
        $this->note->tags()->sync($tags);
        $this->note->fresh();
    }

    public function destroy()
    {
        return $this->note->delete();
    }

    public function archive()
    {
        return $this->note->update([
            'is_archived' => true,
        ]);
    }


    public function setNote(Note $note)
    {
        $this->title = $note->title;
        $this->content = $note->content;
        $this->note = $note;
        $this->tags = $note->tags->map(function ($tag) {
            return $tag->name;
        })->join(',');
    }
}
