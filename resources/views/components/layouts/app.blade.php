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
    <flux:main>
        <flux:header class="border-b py-6 px-8">
            <div class="relative w-full">
                <div class="flex flex-row justify-between">
                    <flux:heading size="xl" level="1">{{ $heading }}</flux:heading>
                    <div class="hidden">
                        <flux:spacer />
                        <livewire:notes.search :searchTerm="request()->get('searchTerm') ?? ''" />
                        <flux:button href="{{ route('settings.profile') }}" icon="cog" variant="ghost" class="ml-2" wire:navigate></flux:button>
                    </div>
                </div>
            </div>
        </flux:header>
        <div class="overflow-y-hidden relative">
            {{ $slot }}
        </div>
    </flux:main>
</x-layouts.app.sidebar>