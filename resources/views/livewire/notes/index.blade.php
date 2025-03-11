@php
    // when clicking on a note from different contexts, direct the user to the correct note
    function getNoteRoute(?App\Models\Note $note, ?App\Models\Tag $tag, string $searchTerm): string
    {
        $routeName = request()->route()->getName();
        if ($note->id) {
            $routeName = str_replace('create', 'note', $routeName);
        }
        $params = ['note' => $note, 'tag' => $tag];
        if (filled($searchTerm)) {
            $params['searchTerm'] = $searchTerm;
        }
        return route($routeName, $params);
    }
@endphp

<div class="flex relative">
    @persist('scrollbar')
    <div wire:scroll
        class="h-[calc(100vh-105px)] overflow-y-auto w-[290px] flex-col pt-5 pr-4 pl-8 border-r border-zinc-200 dark:border-zinc-800">
        <flux:button href="{{route('dashboard.create')}}" variant="primary" class="w-full mb-4">Create New Note
        </flux:button>
        <div class="pb-4 border-b mb-1 border-zinc-200 dark:border-zinc-800">
            @if (request()->routeIs('archive.note'))
                <p>All your archived notes are stored here. You can restore or delete them anytime.</p>
            @elseif (request()->routeIs('tag.note'))
                <p>All notes with the "{{ request()->route('tag')->name }}" tag are shown here</p>
            @endif
        </div>
        <nav class="flex-auto">
            @foreach ($this->notes as $note)
                <a href="{{ getNoteRoute($note, $this->tag, $this->searchTerm) }}"
                    class="border-t first:border-none border-zinc-200 dark:border-zinc-800 hover:bg-zinc-50 dark:hover:bg-zinc-700/75 p-2 flex flex-col space-y-3 hover:rounded-xl"
                    wire:key="{{$note->id}}" wire:current="bg-zinc-100 dark:bg-zinc-800 !border-transparent rounded-xl"
                    wire:navigate>
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
            @if ($this->notes->hasMorePages())
                <button x-intersect:enter="$wire.nextPage" wire:loading.attr="disabled" rel="next">Next</button>
            @endif
        </nav>
    </div>
    @endpersist
    <div class="flex-2/3 px-6 py-5">
        <form wire:submit="save">
            <flux:input type="text" wire:model="form.title" placeholder="Title"></flux:input>
            <flux:input type="text" wire:model="form.tags" placeholder="Tags"></flux:input>
            <flux:textarea name="content" id="content" wire:model="form.content" rows="24"></flux:textarea>
            <flux:button type="submit" variant="primary" class="disabled:opacity-75" wire:dirty.class="bg-blue-900">Save
            </flux:button>
            <flux:button href="{{ route('dashboard') }}">Cancel</flux:button>
        </form>
    </div>
    <div class="border-l dark:border-zinc-600 border-zinc-200 py-5 px-4">
        <flux:navlist variant="outline">
            <flux:navlist.group>
                <flux:navlist.item icon="archive-box-arrow-down" href="#" wire:click="archive"
                    wire:confirm="archive it?">{{ __('Archive Note') }}</flux:navlist.item>
                <flux:navlist.item icon="trash" href="#" wire:click="delete" wire:confirm="delete it?">
                    {{ __('Delete Note') }}
                </flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>
    </div>
</div>