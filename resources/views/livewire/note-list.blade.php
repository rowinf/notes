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
    <flux:button href="{{route('note.create')}}" variant="primary" class="w-full mb-4">Create New Note
    </flux:button>
    @if (request()->routeIs('archive.show'))
        <div class="pb-4 border-b mb-1 empty:hidden">
            <p>All your archived notes are stored here. You can restore or delete them anytime.</p>
        </div>
    @elseif (request()->routeIs('tag.note'))
        <div class="pb-4 border-b mb-1 empty:hidden">
            <p>All notes with the "{{ request()->route('tag')->name }}" tag are shown here</p>
        </div>
    @endif
    <section class="flex-auto">
        @forelse ($notes as $note)
            <div class="note-list-item border-t has-hover:border-transparent">
                <a href="{{ getNoteRoute($note, $this->tag ?? request()->route('tag'), request()->get('searchTerm')) }}"
                    class="my-1 hover:bg-zinc-50 dark:hover:bg-zinc-700/75 p-2 flex flex-col hover:rounded-md"
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
            <p>No notes. Create some?</p>
        @endforelse
        @if ($notes->hasMorePages())
            <button x-intersect:enter="$wire.nextPage" wire:loading.attr="disabled" rel="next">Next</button>
        @endif
    </section>
</div>
@endpersist