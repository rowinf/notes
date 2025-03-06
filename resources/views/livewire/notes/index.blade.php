@php
    // when clicking on a note from different contexts, direct the user to the correct note
    function getNoteRoute(?App\Models\Note $note, ?App\Models\Tag $tag): string
    {
        $routeName = request()->route()->getName();
        if ($note->id) {
            $routeName = str_replace('create', 'note', $routeName);
        }
        return route($routeName, ['note' => $note, 'tag' => $tag]);
    }
@endphp

<div class="flex gap-4 h-full">
    <nav class="flex-auto border-r border-zinc-200">
        <flux:button href="{{route('dashboard.create')}}" variant="primary" class="w-full">Create Note</flux:button>
        @foreach ($this->notes as $note)
            <a href="{{ getNoteRoute($note, $this->tag) }}"
                class="block hover:bg-zinc-50 dark:hover:bg-zinc-700/75" wire:key="{{$note->id}}"
                wire:current="bg-zinc-100 dark:bg-zinc-800">
                <div>{{ $note->title }}</div>
                @foreach ($note->tags as $tag)
                    <span class="p-1 bg-zinc-200 rounded-md dark:bg-zinc-600" wire:key="{{$tag->name}}">{{ $tag->name }}</span>
                @endforeach
                <div>{{ $note->last_edited_at }}</div>
            </a>
        @endforeach
    </nav>
    <div class="flex-2/3">
        <form wire:submit="save">
            <flux:input type="text" id="title" name="title" wire:model="form.title"></flux:input>
            <flux:textarea name="content" id="content" wire:model="form.content" rows="24"></flux:textarea>
            <flux:button type="submit" variant="primary" class="bg-blue-500 text-white disabled:opacity-75" wire:dirty.class="bg-blue-900">Save</flux:button>
            <flux:button href="{{ route('dashboard') }}">Cancel</flux:button>
        </form>
    </div>
</div>