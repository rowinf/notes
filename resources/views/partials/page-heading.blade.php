<flux:header class="lg:bg-zinc-950 border-b">
    <div class="relative w-full">
        <div class="py-6 lg:hidden">
            <a href="{{ route('dashboard') }}" wire:navigate>
                <x-app-logo href="#"></x-app-logo>
            </a>
        </div>
        <div class="hidden flex-row justify-between py-6 lg:flex">
            <flux:heading size="xl" level="1">
                {{ $heading }}
            </flux:heading>
            <flux:spacer />
            <livewire:notes.search :searchTerm="request()->get('searchTerm') ?? ''" />
            <flux:button href="{{ route('settings.profile') }}" icon="cog" variant="ghost" class="ml-2" wire:navigate>
            </flux:button>
        </div>
    </div>
</flux:header>