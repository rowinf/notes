<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
    @include('partials.theme', ['font_theme' => Auth::user()->font_theme])
</head>

<body class="min-h-screen bg-white dark:bg-black overflow-x-hidden"
    x-data="{message: '', isOpen: false}"
    x-on:toast.debounce="message = $event.detail.message; isOpen = !!$event.detail.message"
    x-init="if('{{ request()->get('event') }}' == 'note-created') { $nextTick(() => { message ='Note saved successfully!'; isOpen=true; }) }">
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

    {{ $slot }}
    <div x-cloak class="h-9 absolute bottom-8 right-0 z-10 w-102" x-on:click.outside="$dispatch('toast', {message: false})" x-show="isOpen"
        x-transition:enter="transform-[transition] ease-in-out transition duration-500"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transform-[transition] ease-in-out transition duration-500"
        x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">
        <div class="flex items-center px-2 bg-zinc-800 border rounded-xl w-96">
            <flux:icon.icon-checkmark class="text-green-500 mr-2 size-5" />
            <p class="text-white text-xs flex-1" x-text="message"></p>
            <flux:button variant="subtle" size="sm" icon="x-mark" x-on:click="$dispatch('toast', {message: false})"></flux:button>
        </div>
    </div>
    @fluxScripts
</body>

</html>