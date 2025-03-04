<div class="flex gap-4">
    <nav class="flex-auto">
        @foreach ($this->notes as $note)
            <a href="/dashboard/notes/{{ $note->id }}" class="block hover:bg-zinc-50 dark:hover:bg-zinc-600/75">
                <div>{{ $note->title }}</div>
                <span>{{ $note->tags }}</span>
                <div>{{ $note->last_edited_at }}</div>
            </a>
        @endforeach
    </nav>
    <div class="flex-2/3">
        <div class="flex flex-0 justify-between border-b border-zinc-100 py-4 mb-4">
            <h2 class="text-2xl">
                @if (request()->routeIs("archive"))
                    Archived Notes
                @elseif (request()->routeIs("search"))
                    Showing Results for: (Term)
                @else
                    Notes
                @endif
            </h2>
            <form wire:submit="searchNotes" class="flex">
                <flux:input wire:model="query" id="query" type="search" name="query" required
                    placeholder="{{ __('Search...') }}" />
            </form>
        </div>
        <div id="note-content">
            @if (isset($note) && $note->content)
                @markdown($note->content)
            @else
            (empty)
            @endif
        </div>
    </div>
</div>