<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-zinc-100 dark:bg-zinc-700">
        <div class="p-4 h-[100vh] grid place-items-center">
            <div class="max-w-[540px] w-full bg-white dark:bg-zinc-950 p-12 flex flex-col gap-2 border rounded-xl">
                <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                    <span class="mb-1">
                        <x-app-logo-icon class="w-full fill-current text-black dark:text-white" />
                    </span>
                    <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
                </a>
                <div class="flex flex-col gap-6">
                    {{ $slot }}
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
