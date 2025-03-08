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
    <div class="flex flex-0 justify-between border-b border-zinc-200 dark:border-zinc-700 py-8 px-7">
        <h1 class="text-2xl font-bold">
            @if (request()->routeIs("archive.note"))
                Archived Notes
            @elseif (filled(request()->get('searchTerm')))
                Showing Results for: {{ request()->get('searchTerm') }}
            @elseif (request()->routeIs("tag.note"))
                Notes tagged: {{ request()->route('tag')->name }}
            @else
                All Notes
            @endif
        </h1>
        <livewire:notes.search />
    </div>

    {{ $slot }}
</div>
