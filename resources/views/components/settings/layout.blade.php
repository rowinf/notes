<div class="flex items-start w-full">
    <div class="pt-5 pl-8 pr-4 hidden lg:block">
        <x-settings.menu></x-settings.menu>
    </div>

    <div class="flex-1 self-stretch px-4 pt-6 md:px-8 border-l">
        <flux:button icon:leading="icon-chevron-right" variant="ghost" inset class="lg:hidden"
            :href="route('settings.index')">Settings</flux:button>
        <h2 class="text-2xl font-bold lg:text-base">{{ $heading ?? '' }}</h2>
        <h3 class="text-sm text-zinc-700 dark:text-zinc-300 empty:hidden">{{ $subheading ?? '' }}</h3>

        {{ $slot }}
    </div>
</div>
