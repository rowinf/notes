@props([
    'container' => null,
])

@php
    $classes = Flux::classes('[grid-area:main]')
        ->add('p-0 pt-4 relative dark:bg-zinc-950 bg-white shadow-(--inset-shadow-subtle) rounded-t-2xl lg:rounded-none flex flex-col lg:flex-row')
        ->add('[[data-flux-container]_&]:px-0') // If there is a wrapping container, let IT handle the x padding...
        ->add($container ? 'mx-auto w-full [:where(&)]:max-w-7xl' : '')
    ;
@endphp

<div {{ $attributes->class($classes) }} data-flux-main>
    {{ $slot }}
</div>
