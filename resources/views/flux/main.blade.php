@props([
    'container' => null,
])

@php
    $classes = Flux::classes('[grid-area:main]')
        ->add('p-0 relative')
        ->add('[[data-flux-container]_&]:px-0') // If there is a wrapping container, let IT handle the x padding...
        ->add($container ? 'mx-auto w-full [:where(&)]:max-w-7xl' : '')
    ;
@endphp

<div {{ $attributes->class($classes) }} data-flux-main>
    <div class="px-8 py-6 bg-zinc-100 dark:bg-zinc-800 lg:hidden">
        <a href="{{ route('dashboard') }}" wire:navigate>
            <x-app-logo href="#"></x-app-logo>
        </a>
    </div>
    <div id="main-slot-wrapper" class="h-[calc(100vh-190px)] lg:h-[calc(100vh-90px)]">
        {{ $slot }}
    </div>

    <nav class="flex absolute bottom-0 right-0 left-0 justify-between items-end py-3 px-4 md:px-8 lg:hidden">
        <div class="w-[14vw]">
            <a href="{{ route('note.index') }}" class="flex flex-col items-center px-4 py-1 rounded-md" wire:current="bg-blue-100 text-blue-500 fill-blue-500">
                <flux:icon.icon-home /> 
                <span class="hidden sm:block">Home</span>
            </a>
        </div>
        <flux:separator vertical class="hidden sm:block" />
        <div class="w-[14vw]">
            <a href="/search" class="flex flex-col items-center px-4 py-1 rounded-md" wire:current="bg-blue-100">
                <flux:icon.icon-search />
                <span class="hidden sm:block">Search</span>
            </a>
        </div>
        <flux:separator vertical class="hidden sm:block" />
        <div class="w-[14vw]">
            <a href="{{ route('archive.index') }}" class="flex flex-col items-center px-4 py-1 rounded-md" wire:current="bg-blue-100">
                <flux:icon.icon-home />
                <span class="hidden sm:block">Archived</span></a>
        </div>
        <flux:separator vertical class="hidden sm:block" />
        <div class="w-[14vw]">
            <a href="/tags" class="flex flex-col items-center px-4 py-1 rounded-md" wire:current="bg-blue-100">
                <flux:icon.icon-tag />
                <span class="hidden sm:block">Tags</span>
            </a>
        </div>
        <flux:separator vertical class="hidden sm:block" />
        <div class="w-[14vw]">
            <a href="{{ route('settings.profile') }}" class="flex flex-col items-center px-4 py-1 rounded-md" wire:current="bg-blue-100">
                <flux:icon.icon-settings />
                <span class="hidden sm:block">Settings</span>
            </a>
        </div>
    </nav>
</div>
