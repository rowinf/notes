@php
    $heading = 'All Notes';
    if (request()->routeIs('archive.index')) {
        $heading = 'Archived Notes';
    } else if (request()->routeIs(patterns: 'tag.show')) {
        $heading = 'Notes tagged: ' . request()->route('tag')->name;
    }
    $archive = request()->routeIs('archive.index', 'archive.show');
@endphp
<x-layouts.app.sidebar title="Notes">
    @include('partials.page-heading', ['heading' => $heading])
    <flux:main>
        <flux:heading size="xl" level="1" @class(["lg:hidden border-r pt-5 pl-8 pr-4", "hidden" => request()->routeIs('note.show', 'archive.show', 'tag.note.show')])>
            {{ $heading }}
        </flux:heading>
        <div @class(["lg:flex-[290px] lg:max-w-[290px]", "hidden lg:block" => request()->routeIs('note.show', 'archive.show', 'tag.note.show')])>
            <livewire:note-list :active="!$archive" :archived="$archive"
                class="lg:w-[290px]">
            </livewire:note-list>
        </div>
        {{ $slot }}
    </flux:main>
</x-layouts.app.sidebar>