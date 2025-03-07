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

<div class="flex relative">
    <div
        class="h-[calc(100vh-105px)] overflow-auto flex-[290px] flex-col pt-5 pr-4 pl-8 border-r border-zinc-200 dark:border-zinc-800">
        <flux:button href="{{route('dashboard.create')}}" variant="primary" class="w-full mb-4">Create New Note
        </flux:button>
        @if (request()->routeIs('archive.note'))
            <div class="pb-4 border-b mb-1 border-zinc-200 dark:border-zinc-800">
                <p>All your archived notes are stored here. You can restore or delete them anytime.</p>
            </div>
        @endif
        <nav class="flex-auto">
            @foreach ($this->notes as $note)
                <a href="{{ getNoteRoute($note, $this->tag) }}"
                    class="border-t first:border-none border-zinc-200 dark:border-zinc-800 hover:bg-zinc-50 dark:hover:bg-zinc-700/75 p-2 flex flex-col space-y-3 hover:rounded-xl"
                    wire:key="{{$note->id}}" wire:current="bg-zinc-100 dark:bg-zinc-800 !border-transparent rounded-xl">
                    <div class="font-semibold">{{ $note->title }}</div>
                    <div>
                        @foreach ($note->tags as $tag)
                            <span class="p-1 bg-zinc-200 rounded-md dark:bg-zinc-600 text-xs"
                                wire:key="{{$tag->name}}">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                    <div class="text-xs">{{ $note->last_edited_at }}</div>
                </a>
            @endforeach
        </nav>
    </div>
    <div class="flex-2/3 px-6 py-5">
        <form wire:submit="save">
            <flux:input type="text" id="title" name="title" wire:model="form.title"></flux:input>
            <flux:textarea name="content" id="content" wire:model="form.content" rows="24"></flux:textarea>
            <flux:button type="submit" variant="primary" class="disabled:opacity-75" wire:dirty.class="bg-blue-900">Save
            </flux:button>
            <flux:button href="{{ route('dashboard') }}">Cancel</flux:button>
        </form>
    </div>
    <div class="border-l dark:border-zinc-600 border-zinc-200 py-5 px-4">
        <flux:navlist variant="outline">
            <flux:navlist.group>
                <flux:navlist.item icon="archive-box-arrow-down" href="#" wire:click="archive" wire:confirm="archive it?">{{ __('Archive Note') }}</flux:navlist.item>
                <flux:navlist.item icon="trash" href="#" wire:click="delete" wire:confirm="delete it?">{{ __('Delete Note') }}</flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>
    </div>
</div>