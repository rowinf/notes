@persist('scrollbar')
<div wire:scroll class="overflow-y-auto w-full px-8 border-r [grid-area:innersidebar]">
  <section class="py-6 h-auto">
    @forelse (Auth::user()->tags as $tag)
    <div class="note-list-item border-t first:border-none has-hover:border-transparent">
      <a href="{{ route('tag.show', ['tag' => $tag]) }}" class="py-3 pl-1 gap-2 hover:bg-zinc-100 dark:hover:bg-zinc-700/75 flex hover:rounded-md">
        <flux:icon.tag /> <span>{{ $tag->name }}</span>
      </a>
    </div>
    @empty
    <div>No tags</div>
    @endforelse
  </section>
</div>
@endpersist