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
    {{ $slot }}

    <div class="flex lg:hidden">
        <div>Home</div>
        <div>Search</div>
        <div>Archived</div>
        <div>Tags</div>
        <div>Settings</div>
    </div>

</div>
