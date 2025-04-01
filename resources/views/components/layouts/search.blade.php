@php
    $archive = request()->routeIs('archive.index', 'archive.show');
@endphp
<x-layouts.app.sidebar title="Notes | Search">
    @include('partials.page-heading', ['heading' => "Showing Results for: " . request()->get('searchTerm')])
    <flux:main>
        <div @class(["hidden lg:block" => request()->routeIs('note.show')])>
            <livewire:note-list :active="!$archive" :archived="$archive"
                class="hidden lg:block lg:w-[290px] [grid-area:sidebar]"></livewire:note-list>
        </div>
        {{ $slot }}
    </flux:main>
</x-layouts.app.sidebar>