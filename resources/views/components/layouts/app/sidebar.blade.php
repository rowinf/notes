<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
    @include('partials.theme', ['font_theme' => Auth::user()?->font_theme])
</head>

<body class="h-screen dark:bg-zinc-800 bg-zinc-100 overflow-hidden text-zinc-950 dark:text-white">
    <flux:sidebar sticky stashable class="border-r bg-white dark:bg-zinc-950">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('dashboard') }}" class="mr-5 flex items-center space-x-2" wire:navigate>
            <x-app-logo href="#"></x-app-logo>
        </a>

        <flux:navlist variant="outline">
            <flux:navlist.group class="grid">
                <flux:navlist.item icon="icon-home" :href="route('dashboard')" :current="request()->routeIs('note.create', 'note.show', 'note.index')">{{ __('Dashboard') }}</flux:navlist.item>
                <flux:navlist.item icon="icon-archive" :href="route('archive')"
                    :current="request()->routeIs('archive.index', 'archive.show')">{{ __('Archived Notes') }}
                </flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>

        <flux:separator />

        <flux:navlist variant="outline">
            <livewire:tags.index />
        </flux:navlist>

        <flux:spacer />
    </flux:sidebar>

    <div id="dialogs"></div>
    @include('partials.mobile-nav')
    @persist('toast')
    <div x-cloak x-data="$store.toasts" class="h-9 absolute bottom-8 right-0 z-100 w-102"
        x-on:click.outside="toast(false)" x-show="isOpen"
        x-transition:enter="transform-[transition] ease-in-out transition duration-500"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transform-[transition] ease-in-out transition duration-500"
        x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">
        <div class="flex items-center px-2 bg-white dark:bg-zinc-800 border rounded-xl w-96">
            <flux:icon.icon-checkmark class="text-green-500 mr-2 size-5" />
            <p class="dark:text-white text-xs flex-1" x-text="message"></p>
            <flux:button variant="subtle" size="sm" icon="x-mark" x-on:click="toast(false)"></flux:button>
        </div>
    </div>
    @endpersist
    @fluxScripts
    {{ $slot }}
</body>

</html>
