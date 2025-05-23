@persist('scrollbar')
<div wire:scroll class="overflow-y-auto w-full px-8 border-r [grid-area:innersidebar]">
    <section class="py-6 h-auto">
        @forelse ($tags as $tag)
            <div class="note-list-item border-b last:border-none">
                <a href="{{ route('tag.show', ['tag' => $tag]) }}"
                    class="w-full inline-flex items-center py-3 pl-1 gap-2 hover:bg-zinc-100 dark:hover:bg-zinc-700/75 hover:rounded-md">
                    <flux:icon.tag class="size-5" /> <span>{{ $tag->name }}</span>
                </a>
            </div>
        @empty
            <div>No tags</div>
        @endforelse
    </section>
</div>
@endpersist
