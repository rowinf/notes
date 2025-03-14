
<x-layouts.app.sidebar>
    <flux:main>
        <div class="overflow-y-hidden flex relative">
            <livewire:note-list></livewire:note-list>
            <div class="flex flex-2/3 h-[calc(100vh-105px)]">
                {{ $slot }}
            </div>
        </div>
    </flux:main>
</x-layouts.app.sidebar>