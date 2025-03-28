<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ Auth::user()->color_theme }}">

<head>
    @include('partials.head')
    @include('partials.theme', ['font_theme' => Auth::user()->font_theme])
</head>

<body class="min-h-screen bg-white dark:bg-black overflow-x-hidden"
     x-on:toast.debounce="$store.toasts.toast($event.detail.message)">
    <flux:sidebar sticky stashable class="border-r bg-white dark:bg-black">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('dashboard') }}" class="mr-5 flex items-center space-x-2" wire:navigate>
            <x-app-logo class="size-8" href="#"></x-app-logo>
        </a>

        <flux:navlist variant="outline">
            <flux:navlist.group class="grid">
                <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('note.create', 'note.show', 'note.index')">{{ __('Dashboard') }}</flux:navlist.item>
                <flux:navlist.item icon="archive-box-arrow-down" :href="route('archive')"
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
    @include("partials.page-heading")

    <div id="dialogs"></div>
    @persist('toast')
    <div x-cloak x-data="$store.toasts" class="h-9 absolute bottom-8 right-0 z-100 w-102" x-on:click.outside="toast(false)" x-show="isOpen"
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