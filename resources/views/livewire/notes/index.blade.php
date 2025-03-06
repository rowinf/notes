<div class="flex gap-4 h-full">
    <nav class="flex-auto border-r border-zinc-200">
        <flux:button href="{{route('dashboard.create')}}" variant="primary" class="w-full">Create Note</flux:button>
        @foreach ($this->notes as $note)
            <a href="{{ route('dashboard.note', ['note' => $note]) }}"
                class="block hover:bg-zinc-50 dark:hover:bg-zinc-600/75" wire:key="{{$note->id}}"
                wire:current="bg-zinc-100">
                <div>{{ $note->title }}</div>
                @foreach ($note->tags as $tag)
                    <span class="p-1 bg-zinc-200 rounded-md" wire:key="{{$tag->name}}">{{ $tag->name }}</span>
                @endforeach
                <div>{{ $note->last_edited_at }}</div>
            </a>
        @endforeach
    </nav>
    <div class="flex-2/3">
        <form wire:submit="save">
            <flux:input type="text" id="title" name="title" wire:model="form.title"></flux:input>
            <flux:textarea name="content" id="content" wire:model="form.content" rows="24"></flux:textarea>
            <flux:button type="submit" variant="primary">Save</flux:button>
            <flux:button href="{{ route('dashboard') }}">Cancel</flux:button>
        </form>
    </div>
</div>