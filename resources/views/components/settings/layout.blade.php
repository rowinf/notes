<div class="flex items-start w-full">
    <div class="pt-5 pl-8 pr-4 hidden md:block">
        <flux:navlist class="h-auto gap-1 w-52">
            <flux:navlist.item href="{{ route('settings.appearance') }}" icon="icon-sun" wire:current="bg-zinc-100 dark:bg-zinc-800" wire:navigate>{{ __('Color Theme') }}</flux:navlist.item>
            <flux:navlist.item href="{{ route('settings.font-theme') }}" icon="icon-font" wire:current="bg-zinc-100 dark:bg-zinc-800" wire:navigate>{{ __('Font Theme') }}</flux:navlist.item>
            <flux:navlist.item href="{{ route('settings.password') }}" icon="icon-lock" wire:current="bg-zinc-100 dark:bg-zinc-800" wire:navigate>{{ __('Change Password') }}</flux:navlist.item>
            <flux:separator />
            <form method="POST" action="{{route('logout')}}">
                @csrf
                <flux:navlist.item type="submit" icon="icon-logout">{{ __('Logout') }}</flux:navlist.item>
            </form>
        </flux:navlist>
    </div>

    <div class="flex-1 self-stretch px-4 pt-6 md:px-8 border-l">
        <flux:button icon:leading="icon-chevron-right" variant="ghost" inset class="lg:hidden"
            :href="route('settings.index')">Settings</flux:button>
        <h2 class="text-2xl font-bold lg:text-base">{{ $heading ?? '' }}</h2>
        <h3 class="text-sm text-zinc-700 dark:text-zinc-300 empty:hidden">{{ $subheading ?? '' }}</h3>

        {{ $slot }}
    </div>
</div>
