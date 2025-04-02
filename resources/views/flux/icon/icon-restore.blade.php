
@props([
    'variant' => 'outline',
])

@php
    if ($variant === 'solid') {
        throw new \Exception('The "solid" variant is not supported in Lucide.');
    }

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
        'micro' => 1.3,
    };
@endphp

<svg
    {{ $attributes->class($classes) }}
    data-flux-icon
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 24 24"
    fill="none"
    stroke="currentColor"
    stroke-width="{{ $strokeWidth }}"
    stroke-linecap="round"
    stroke-linejoin="round"
    aria-hidden="true"
    data-slot="icon"
><path fill="#0E121B" fill-rule="evenodd" d="M3.708 7.404a.75.75 0 0 1 .983.398l1.316 3.114L9.1 9.608a.75.75 0 0 1 .584 1.382L5.9 12.59a.75.75 0 0 1-.983-.4L3.309 8.387a.75.75 0 0 1 .4-.982Z" clip-rule="evenodd"/><path fill="#0E121B" fill-rule="evenodd" d="M12.915 5.664c-3.447 0-6.249 2.746-6.335 6.16a.75.75 0 0 1-1.5-.038c.108-4.228 3.575-7.622 7.835-7.622a7.838 7.838 0 0 1 7.835 7.835 7.833 7.833 0 0 1-7.835 7.835 7.843 7.843 0 0 1-6.457-3.384.75.75 0 1 1 1.232-.856 6.343 6.343 0 0 0 5.225 2.74 6.333 6.333 0 0 0 6.335-6.335 6.339 6.339 0 0 0-6.335-6.335Z" clip-rule="evenodd"/></svg>