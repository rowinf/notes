<?php
use Livewire\Volt\Component;

use Livewire\Attributes\On;
new class extends Component {

    public int $noteId = -1;
    public string $title = '';
    public string $class = '';

    #[On('title-updated.{noteId}')]
    public function titleUpdatedEditor($title)
    {
        $this->title = $title;
    }
}; ?>

<div class="{{ $this->class }}">{{ $this->title ?: "Untitled Note" }}</div>
