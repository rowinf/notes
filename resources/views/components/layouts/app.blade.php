@php
    $archive = Route::is('archive.index', 'archive.show');
@endphp
<x-layouts.app.sidebar title="Notes"> 
    @include('partials.page-heading')
    <flux:main>
        @if (Route::is('tag.show'))
            <flux:button icon:leading="icon-chevron-right" variant="ghost" class="px-7! self-start lg:hidden" :href="route('tag.index')">All tags</flux:button>
        @endif
        <flux:heading size="xl" level="1" @class(["lg:hidden border-r pl-8 pr-4 pt-4", "hidden" => Route::is('note.show', 'archive.show', 'tag.note.show', 'note.create')])>
            @include('partials.subheading')
        </flux:heading>
        <div @class(["lg:flex-[290px] lg:max-w-[290px]", "hidden lg:block" => Route::is('note.show', 'archive.show', 'tag.note.show', 'note.create')])>
            <livewire:note-list :active="!$archive" :archived="$archive">
            </livewire:note-list>
        </div>
        {{ $slot }}
    </flux:main>
</x-layouts.app.sidebar>