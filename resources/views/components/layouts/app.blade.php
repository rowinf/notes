@php
    $archive = Route::is('archive.index', 'archive.show');
@endphp
<x-layouts.app.sidebar title="Notes">
    @include('partials.page-heading')
    <flux:main x-data="{hideUntitled: !location.href.match(/\/dashboard\/notes\/create$/)}"
    x-on:note-added.window="hideUntitled = false">
        @if (Route::is('tag.show'))
            <flux:button icon:leading="icon-chevron-right" variant="ghost" class="px-7! self-start lg:hidden" :href="route('tag.index')">All tags</flux:button>
        @endif
        <flux:heading size="xl" level="1" @class(["lg:hidden border-r pl-8 pr-4 pt-4", "hidden" => Route::is('note.show', 'archive.show', 'tag.note.show', 'note.create')])>
            @include('partials.subheading')
        </flux:heading>
        <x-note-list.column>
            <livewire:note-list :active="!$archive" :archived="$archive">
            </livewire:note-list>
        </x-note-list.column>
        {{ $slot }}
    </flux:main>
</x-layouts.app.sidebar>
