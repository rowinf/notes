<div class="flex items-start">
    <div class="mr-10 pt-5 pl-8 pr-4 border-r hidden md:block">
        <flux:navlist class="h-screen gap-1 w-52">
            <flux:navlist.item href="{{ route('settings.appearance') }}" icon="icon-sun" wire:navigate>{{ __('Color Theme') }}</flux:navlist.item>
            <flux:navlist.item href="{{ route('settings.font-theme') }}" icon="icon-font" wire:navigate>{{ __('Font Theme') }}</flux:navlist.item>
            <flux:navlist.item href="{{ route('settings.password') }}" icon="icon-lock" wire:navigate>{{ __('Change Password') }}</flux:navlist.item>
            <flux:separator />
            <form method="POST" action="{{route('logout')}}">
                @csrf
                <flux:navlist.item type="submit" icon="icon-logout">{{ __('Logout') }}</flux:navlist.item>
            </form>
        </flux:navlist>
    </div>

    <div class="flex-1 self-stretch pt-6">
        <flux:heading size="xl" level="2">{{ $heading ?? '' }}</flux:heading>
        <flux:subheading>{{ $subheading ?? '' }}</flux:subheading>

        {{ $slot }}
    </div>
</div>
