<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
    @include('partials.theme', ['font_theme' => Auth::user()->font_theme])
</head>

<body class="min-h-screen bg-white dark:bg-black overflow-x-hidden"
    x-data="{message: '', isOpen: false, toast(message) { if (message) {console.log('toast'); this.message = message; this.isOpen = true;} }, untoast() {console.log('untoast'); this.isOpen = false;} }"
    x-on:toast="toast($event.detail.message)"
    x-init="if('{{ request()->get('event') }}' == 'note-created') { $nextTick(() => toast('Note Created!')) }">
    <flux:sidebar sticky stashable class="border-r border-zinc-200 bg-white dark:border-zinc-700 dark:bg-black">
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

        <!-- Desktop User Menu -->
        <flux:dropdown position="bottom" align="start">
            <flux:profile :name="auth()->user()->name" :initials="auth()->user()->initials()"
                icon-trailing="chevrons-up-down" />

            <flux:menu class="w-[220px]">
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-left text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item href="/settings/profile" icon="cog" wire:navigate>{{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>
    @include("partials.page-heading")
    <!-- Mobile User Menu -->
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        <flux:dropdown position="top" align="end">
            <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-left text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item href="/settings/profile" icon="cog" wire:navigate>Settings</flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    {{ $slot }}
    <div x-cloak 
        class="h-9 absolute bottom-8 right-0 z-10 w-102"
        x-on:click.outside="untoast()"
        x-show="isOpen"
        x-transition:enter="transform-[transition] ease-in-out transition duration-500"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transform-[transition] ease-in-out transition duration-500"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full">
        <div class="flex items-center px-2 bg-zinc-800 border border-zinc-700 rounded-xl w-96">
            <flux:icon.icon-checkmark class="text-green-500 mr-2 size-5" />
            <p class="text-white text-xs flex-1" x-text="message"></p>
            <flux:button variant="subtle" size="sm" icon="x-mark" x-on:click="untoast()"></flux:button>
        </div>
    </div>
    @fluxScripts
</body>

</html>