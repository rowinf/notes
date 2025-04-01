<x-layouts.app.sidebar title="Notes | Search">
    @include('partials.page-heading', ['heading' => "Showing Results for: " . request()->get('searchTerm')])
    <flux:main>
        <div @class(["hidden lg:block" => request()->routeIs('note.show')])>
            <livewire:note-list :active="true" :archived="true"
                class="hidden lg:block lg:w-[290px] [grid-area:sidebar]"></livewire:note-list>
        </div>
        {{ $slot }}
    </flux:main>
</x-layouts.app.sidebar>