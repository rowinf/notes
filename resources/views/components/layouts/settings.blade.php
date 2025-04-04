<x-layouts.app.sidebar title="Notes | Settings" heading="Settings">
    @include('partials.page-heading')
    <flux:header class="lg:dark:bg-zinc-950 lg:bg-white lg:border-b lg:hidden">
        <a href="{{ route('dashboard') }}" wire:navigate>
            <x-app-logo href="#"></x-app-logo>
        </a>
    </flux:header>
    <flux:main>
        {{ $slot }}
    </flux:main>
</x-layouts.app.sidebar>