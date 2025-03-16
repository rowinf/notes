<x-layouts.app.sidebar title="Notes | Settings" heading="Settings">
    <flux:main>
        <div class="overflow-y-hidden flex relative">
            <div class="flex flex-2/3 h-[calc(100vh-105px)]">
                {{ $slot }}
            </div>
        </div>
    </flux:main>
</x-layouts.app.sidebar>