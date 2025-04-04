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
            'micro' => '[:where(&)]:size-6'
        },
    );

    $strokeWidth = match ($variant) {
        'outline' => 2,
        'mini' => 2.25,
        'micro' => 2.5,
        'lg' => 2.5
    };
@endphp

<svg 
    {{ $attributes->class($classes) }} 
    data-flux-icon
    xmlns="http://www.w3.org/2000/svg" 
    width="14" 
    height="18" 
    fill="none" 
    stroke-width="{{ $strokeWidth }}"
    viewBox="0 0 24 24"
    aria-hidden="true"
    data-slot="icon"
    transform="rotate(180)"
><path fill="currentColor" fill-rule="evenodd" d="M9.47 7.47a.75.75 0 0 1 1.06 0l4 4a.75.75 0 0 1 0 1.06l-4 4a.75.75 0 1 1-1.06-1.06L12.94 12 9.47 8.53a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd"/></svg>