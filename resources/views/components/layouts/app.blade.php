@php
    $heading = 'All Notes';
    if (request()->routeIs('archive.index')) {
        $heading = 'Archived Notes';
    } else if (request()->routeIs(patterns: 'tag.index')) {
        $heading = 'Notes tagged: ' . request()->route('tag')->name;
    }
@endphp
<x-layouts.app.sidebar title="Notes" heading="{{ $heading }}">
    <flux:main>
        <div class="overflow-y-hidden flex relative">
            <livewire:note-list></livewire:note-list>
            <div class="flex flex-2/3 h-[calc(100vh-105px)]">
                {{ $slot }}
            </div>
        </div>
    </flux:main>
</x-layouts.app.sidebar>