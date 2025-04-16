<flux:header class="lg:dark:bg-zinc-950 lg:bg-white lg:border-b">
    <div class="relative w-full">
        <div class="py-6 lg:hidden">
            <a href="{{ route('dashboard') }}" wire:navigate>
                <x-app-logo href="#"></x-app-logo>
            </a>
        </div>
        <div class="hidden flex-row justify-between py-6 lg:flex">
            <flux:heading size="xl" level="1">
                @include('partials.subheading')
            </flux:heading>
            <flux:spacer />
            <livewire:search-form :searchTerm="request()->get('searchTerm') ?? ''" />
            <flux:button href="{{ route('settings.appearance') }}" icon="icon-settings" variant="ghost" class="ml-2 text-zinc-500! dark:text-zinc-400!" wire:navigate>
            </flux:button>
        </div>
    </div>
</flux:header>
