<x-layouts.app.sidebar title="Notes | Search">
    @include('partials.page-heading')
    <flux:main x-data="{hideUntitled: true}">
        <flux:heading size="xl" level="1" @class(["lg:hidden border-r pt-5 pl-8 pr-4", "hidden" => Route::is('search.note')])>
            <div>Search</div>
            <div class="mt-4">
                <livewire:search-form :searchTerm="request()->get('searchTerm') ?? ''" />
                @if (request('searchTerm'))
                    <p class="mt-4 text-sm">All notes matching "{{ request('searchTerm') }}" are displayed below.</p>
                @endif
            </div>
        </flux:heading>
        <x-note-list.column>
            <livewire:note-list :active="true" :archived="true"></livewire:note-list>
        </x-note-list.column>
        {{ $slot }}
    </flux:main>
</x-layouts.app.sidebar>
