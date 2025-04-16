
@props([
    'variant' => 'outline',
])

@php
    $classes = Flux::classes('shrink-0')->add(
        match ($variant) {
            'outline' => '[:where(&)]:size-6',
            'solid' => '[:where(&)]:size-6',
            'mini' => '[:where(&)]:size-5',
            'micro' => '[:where(&)]:size-4',
        },
    );

    $strokeWidth = match ($variant) {
        'outline' => 2,
        'mini' => 2.25,
        'micro' => 2.5,
    };
@endphp

<svg
    {{ $attributes->class($classes) }}
    data-flux-icon
    xmlns="http://www.w3.org/2000/svg"
    width="24"
    height="24"
    fill="none"
    stroke-width="{{ $strokeWidth }}"
    viewBox="0 0 24 24"
    aria-hidden="true"
    data-slot="icon"
>
    <path fill="currentColor" fill-rule="evenodd"
        d="M11.248 3.5a7.289 7.289 0 1 0 0 14.577 7.289 7.289 0 0 0 0-14.577ZM2.46 10.79a8.789 8.789 0 1 1 17.577 0 8.789 8.789 0 0 1-17.577 0Z"
        clip-rule="evenodd" />
    <path fill="currentColor" fill-rule="evenodd" d="m16.736 15.648 5.616 5.6-1.06 1.063-5.615-5.601 1.06-1.062Z"
        clip-rule="evenodd" />
</svg>
