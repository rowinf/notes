@props([
    'container' => null,
])

@php
$classes = Flux::classes('[grid-area:main]')
    ->add('p-0')
    ->add('[[data-flux-container]_&]:px-0') // If there is a wrapping container, let IT handle the x padding...
    ->add($container ? 'mx-auto w-full [:where(&)]:max-w-7xl' : '')
    ;
@endphp

<div {{ $attributes->class($classes) }} data-flux-main>
    <div class="flex flex-0 justify-between border-b border-zinc-200 py-4 mb-4">
        <h1 class="text-2xl">
            @if (request()->routeIs("archive"))
                Archived Notes
            @elseif (request()->routeIs("search"))
                Showing Results for: (Term)
            @else
                Notes
            @endif
        </h1>
        <form wire:submit="searchNotes" class="flex">
            <flux:input wire:model="query" id="query" type="search" name="query" required
                placeholder="{{ __('Search by title, content, or tags...') }}" />
        </form>
    </div>
    
    {{ $slot }}
</div>
