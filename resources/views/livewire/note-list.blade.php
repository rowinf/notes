@php
    // when clicking on a note from different contexts, direct the user to the correct note
    function getNoteRoute(?App\Models\Note $note, ?App\Models\Tag $tag, ?string $searchTerm): string
    {
        $routeName = request()->route()->getName();
        $params = ['note' => $note, 'tag' => $tag];

        if ($note->id) {
            if (str_contains($routeName, 'archive')) {
                return route('archive.show', $params);
            } else if (str_contains($routeName, 'tag')) {
                return route('tag.show', $params);
            } else {
                if (filled($searchTerm)) {
                    $params['searchTerm'] = $searchTerm;
                }
                return route('note.show', $params);
            }
        }
        return route('note.show', $params);
    }
@endphp

@persist('scrollbar')
<div wire:scroll class="h-[calc(100vh-90px)] overflow-y-auto w-[290px] flex-col pt-5 pr-4 pl-8 border-r">
    <flux:button href="{{route('note.create')}}" variant="primary" class="w-full">Create New Note
    </flux:button>
    @if (request()->routeIs('archive.index', 'archive.show'))
        <p class="text-sm pt-4">All your archived notes are stored here. You can restore or delete them anytime.</p>
    @elseif (request()->routeIs('tag.note'))
        <p class="text-sm pt-4">All notes with the "{{ request()->route('tag')->name }}" tag are shown here</p>
    @endif
    <section class="flex-auto pt-4">
        @forelse ($notes as $note)
            <div class="note-list-item border-t has-hover:border-transparent">
                <a href="{{ getNoteRoute($note, $this->tag ?? request()->route('tag'), request()->get('searchTerm')) }}"
                    class="my-1 hover:bg-zinc-100 dark:hover:bg-zinc-700/75 p-2 flex flex-col hover:rounded-md"
                    wire:key="{{$note->id}}" wire:current="bg-zinc-100 dark:bg-zinc-800 border-transparent rounded-md"
                    wire:navigate>
                    <div class="font-semibold">{{ $note->title }}</div>
                    @if ($note->tags->isNotEmpty())
                        <div class="pt-2">
                            @foreach ($note->tags as $tag)
                                <span class="p-1 bg-zinc-100 rounded-md dark:bg-zinc-600 text-xs"
                                    wire:key="{{$tag->id}}">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    @endif
                    @if ($note->last_edited_at)
                        <div class="text-xs pt-3">{{ $note->last_edited_at }}</div>
                    @endif
                </a>
            </div>
        @empty
            <div class="p-2 border dark:border-zinc-700 dark:bg-zinc-800 rounded-lg">
                <p class="text-sm">
                    @if (request()->routeIs('archive.index'))
                        No notes have been archived yet. Move notes here for safekeeping, or <flux:link
                            href="{{route('note.create')}}" class="underline underline-offset-2!" variant="subtle"
                            wire:navigate>create a new note</flux:link>.
                            @elseif (request()->routeIs('tag.index'))
                            No notes with this tag. <flux:link href="{{route('note.create')}}" class="underline underline-offset-2!"
                            variant="subtle" wire:navigate>Create a new note
                        </flux:link>
                    @else
                        You don't have any notes yet. Start a new note to capture your thoughts and ideas.
                    @endif
                </p>
            </div>
        @endforelse
        @if ($notes->hasMorePages())
            <button x-intersect:enter="$wire.nextPage" wire:loading.attr="disabled" rel="next">Next</button>
        @endif
    </section>
</div>
@endpersist