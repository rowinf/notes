@php
    $heading = 'All Notes';
    if (request()->routeIs('archive.index')) {
        $heading = 'Archived Notes';
    } else if (request()->routeIs(patterns: 'tag.index')) {
        $heading = 'Notes tagged: ' . request()->route('tag')->name;
    }
    $archive = request()->routeIs('archive.index', 'archive.show');
@endphp
<x-layouts.app.sidebar title="Notes" heading="{{ $heading }}">
    <flux:header class="lg:bg-zinc-950 border-b">
        <div class="relative w-full">
            <div class="py-6 lg:hidden">
                <a href="{{ route('dashboard') }}" wire:navigate>
                    <x-app-logo href="#"></x-app-logo>
                </a>
            </div>
            <div class="hidden flex-row justify-between py-6 lg:flex">
                <flux:heading size="xl" level="1">
                    {{ $heading }}
                </flux:heading>
                <flux:spacer />
                <livewire:notes.search :searchTerm="request()->get('searchTerm') ?? ''" />
                <flux:button href="{{ route('settings.profile') }}" icon="cog" variant="ghost" class="ml-2"
                    wire:navigate></flux:button>
            </div>
        </div>
    </flux:header>
    <flux:main class="bg-zinc-950 rounded-t-2xl lg:rounded-none grid">
        <flux:heading size="xl" level="1" @class(["border-r pt-5 pl-8 pr-4 [grid-area:header]", "hidden" => request()->routeIs('note.show')])>
            {{ $heading }}
        </flux:heading>
        <div @class(["hidden lg:block" => request()->routeIs('note.show')])>
            <livewire:note-list :active="!$archive" :archived="$archive" class="hidden lg:block lg:w-[290px] [grid-area:sidebar]"></livewire:note-list>
        </div>
        {{ $slot }}
    </flux:main>
</x-layouts.app.sidebar>