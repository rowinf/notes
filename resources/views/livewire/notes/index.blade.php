@php
    // when clicking on a note from different contexts, direct the user to the correct note
    function getNoteRoute(?App\Models\Note $note, ?App\Models\Tag $tag, string $searchTerm): string
    {
        $routeName = request()->route()->getName();
        if ($note->id) {
            $routeName = str_replace('create', 'show', $routeName);
            $routeName = str_replace('index', 'show', $routeName);
        }
        $params = ['note' => $note, 'tag' => $tag];
        if (filled($searchTerm)) {
            $params['searchTerm'] = $searchTerm;
        }
        return route($routeName, $params);
    }
@endphp

<div class="overflow-y-hidden flex relative">
    @persist('scrollbar')
    <div wire:scroll
        class="h-[calc(100vh-105px)] overflow-y-auto w-[290px] flex-col pt-5 pr-4 pl-8 border-r border-zinc-200 dark:border-zinc-800">
        <flux:button href="{{route('note.create')}}" variant="primary" class="w-full mb-4">Create New Note
        </flux:button>
        @if (request()->routeIs('archive.show'))
            <div class="pb-4 border-b mb-1 border-zinc-200 dark:border-zinc-800 empty:hidden">
                <p>All your archived notes are stored here. You can restore or delete them anytime.</p>
            </div>
        @elseif (request()->routeIs('tag.note'))
            <div class="pb-4 border-b mb-1 border-zinc-200 dark:border-zinc-800 empty:hidden">
                <p>All notes with the "{{ request()->route('tag')->name }}" tag are shown here</p>
            </div>
        @endif
        <nav class="flex-auto">
            @forelse ($this->notes as $note)
                <a href="{{ getNoteRoute($note, $this->tag, $this->searchTerm) }}"
                    class="border-t first:border-none border-zinc-200 dark:border-zinc-800 hover:bg-zinc-50 dark:hover:bg-zinc-700/75 p-2 mb-2 flex flex-col hover:rounded-xl"
                    wire:key="{{$note->id}}" wire:current="bg-zinc-100 dark:bg-zinc-800 !border-transparent rounded-xl"
                    wire:navigate>
                    <div class="font-semibold">{{ $note->title }}</div>
                    @if ($note->tags->isNotEmpty())
                        <div class="pt-2">
                            @foreach ($note->tags as $tag)
                                <span class="p-1 bg-zinc-200 rounded-md dark:bg-zinc-600 text-xs"
                                    wire:key="{{$tag->name}}">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    @endif
                    @if ($note->last_edited_at)
                        <div class="text-xs pt-3">{{ $note->last_edited_at }}</div>
                    @endif
                </a>
            @empty
                <p>No notes. Create some?</p>
            @endforelse
            @if ($this->notes->hasMorePages())
                <button x-intersect:enter="$wire.nextPage" wire:loading.attr="disabled" rel="next">Next</button>
            @endif
        </nav>
    </div>
    @endpersist
    <div class="flex flex-2/3 px-6 py-5 h-[calc(100vh-105px)]">
        @if ($this->form->note)
            <form wire:submit="save" class="flex flex-col flex-1">
                <div class="grid">
                    <div x-data="{open: false}">
                        <button class="text-2xl font-bold text-left cursor-pointer mb-2" type="button"
                            x-on:click="open = !open" x-text="$wire.form.title" x-show="!open"></button>
                        <flux:field x-show="open">
                            <flux:input type="text" wire:model="form.title" placeholder="Title"
                                @click.outside="open = false" />
                        </flux:field>
                    </div>
                    <div class="flex items-center mb-1" x-data="{open: false}">
                        <div class="w-50 flex items-center mb-1">
                            <flux:icon.tag class="size-4" /><span class="ml-1 text-sm align-baseline">Tags</span>
                        </div>
                        <button @class(["text-sm text-left cursor-pointer", 'text-white' => $form->tags, 'text-zinc-100' => !$form->tags]) type="button" x-on:click="open = !open" x-text="$wire.form.tags || 'tags, etc'"
                            x-show="!open"></button>
                        <flux:field x-show="open">
                            <flux:input type="text" wire:model="form.tags" placeholder="Tags" @click.outside="open = false"
                                size="xs" />
                        </flux:field>
                    </div>
                    <div class="flex items-center">
                        <div class="flex items-center w-50">
                            <flux:icon.clock class="size-4" /><span class="ml-1 text-sm align-baseline">Last Edited</span>
                        </div>
                        <p class="text-left text-sm">
                            {{ optional($this->form->note->last_edited_at, function () {
            return 'Not yet saved'; }) }}</p>
                    </div>
                </div>
                <flux:separator class="my-4" />

                <flux:textarea class="flex-1 min-h-min" name="content" id="content" wire:model="form.content">
                </flux:textarea>
                <flux:separator class="my-4" />
                <div>
                    <flux:button type="submit" variant="primary" class="disabled:opacity-75 mr-2"
                        wire:dirty.class="bg-blue-900">Save Note
                    </flux:button>
                    <flux:button href="{{ route('note.index') }}">Cancel</flux:button>
                </div>
            </form>
        @endif
    </div>
    @if ($this->form->note->id)
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
    @endif
</div>