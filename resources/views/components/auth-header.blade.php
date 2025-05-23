@props([
    'title',
    'description',
])

<div class="flex w-full flex-col gap-2 text-center">
    <h1 class="text-2xl font-bold dark:text-zinc-200">{{ $title }}</h1>
    <p class="text-center text-sm dark:text-zinc-300">{{ $description }}</p>
</div>
