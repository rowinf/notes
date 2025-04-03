<x-layouts.app.sidebar title="Notes | Search">
    @include('partials.page-heading')
    <flux:main>
        <flux:heading size="xl" level="1" @class(["lg:hidden border-r pt-5 pl-8 pr-4", "hidden" => Route::is('search.note')])>
            <div>Search</div>
            <div class="mt-4">
                <livewire:search-form :searchTerm="request()->get('searchTerm') ?? ''" />
                @if (request('searchTerm'))
                    <p class="mt-4 text-sm">All notes matching "{{ request('searchTerm') }}" are displayed below.</p>
                @endif
            </div>
        </flux:heading>
        <div data-note-sidebar @class(["lg:flex-[290px] lg:max-w-[290px]", "hidden lg:block" => Route::is('search.note')])>
            <livewire:note-list :active="true" :archived="true"></livewire:note-list>
        </div>
        {{ $slot }}
    </flux:main>
</x-layouts.app.sidebar>