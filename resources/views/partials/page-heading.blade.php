<flux:header class="border-b dark:border-zinc-600 border-zinc-200 py-6 px-8">
    <div class="relative flex-wrap w-full">
        <div class="flex flex-row justify-between">
            <flux:heading size="xl" level="1">{{ $heading }}</flux:heading>
            <flux:spacer />
            <livewire:notes.search :searchTerm="request()->get('searchTerm') ?? ''" />
            <flux:button href="{{ route('settings.profile') }}" icon="cog" variant="ghost" class="ml-2" wire:navigate></flux:button>
        </div>
    </div>
</flux:header>