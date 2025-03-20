@php
    $classes = Flux::classes('shrink-0')
@endphp

<svg 
    {{ $attributes->class($classes) }} 
    data-flux-icon
    xmlns="http://www.w3.org/2000/svg" 
    width="24" 
    height="24" 
    fill="none" 
    viewBox="0 0 24 24"
    aria-hidden="true"
    data-slot="icon"
>
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12.055 3v1.372m0 15.256V21m9-9h-1.372M4.427 12H3.055m15.364-6.364-.97.97M6.66 17.394l-.97.97m12.728 0-.97-.97M6.66 6.606l-.97-.97"/>
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12.055 7.805a4.195 4.195 0 1 1 0 8.39 4.195 4.195 0 0 1 0-8.39Z" clip-rule="evenodd"/>
</svg>