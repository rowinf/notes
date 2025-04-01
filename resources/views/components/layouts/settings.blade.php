<x-layouts.app.sidebar title="Notes | Settings" heading="Settings">
    <flux:main>
        <div class="flex relative h-full">
            <div class="flex flex-2/3 h-[calc(100vh-105px)]">
                {{ $slot }}
            </div>
        </div>
    </flux:main>
</x-layouts.app.sidebar>