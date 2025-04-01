@php
    $subheading = request()->get('searchTerm');
@endphp
<x-layouts.app.sidebar title="Notes | Search">
    @include('partials.page-heading', ['heading' => "Search"])
    <flux:main>
        <flux:heading size="xl" level="1" @class(["lg:hidden border-r pt-5 pl-8 pr-4 [grid-area:innerheader]", "hidden" => request()->routeIs('note.show')])>
            <div>Search</div>
            <div class="mt-4">
                <livewire:search-form :searchTerm="request()->get('searchTerm') ?? ''" />
                @if ($subheading)
                    <p class="mt-4 text-sm">Showing Results for: {{ $subheading }}</p>
                @endif
            </div>
        </flux:heading>
        <div data-note-sidebar @class(["[grid-area:innersidebar]", "hidden lg:block" => request()->routeIs('note.show')])>
            <livewire:note-list :active="true" :archived="true"
                class="lg:w-[290px]"></livewire:note-list>
        </div>
        {{ $slot }}
    </flux:main>
</x-layouts.app.sidebar>