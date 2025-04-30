<flux:navlist class="gap-1">
    <flux:navlist.item href="{{ route('settings.appearance') }}" icon="icon-sun" wire:navigate>
        {{ __('Color Theme') }}
    </flux:navlist.item>
    <flux:navlist.item href="{{ route('settings.font-theme') }}" icon="icon-font" wire:navigate>
        {{ __('Font Theme') }}
    </flux:navlist.item>
    <flux:navlist.item href="{{ route('settings.password') }}" icon="icon-lock" wire:navigate>
        {{ __('Change Password') }}
    </flux:navlist.item>
    <flux:separator class="dark:bg-zinc-800!" />

    @if (auth()->check())
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <flux:navlist.item type="submit" icon="icon-logout">{{ __('Logout') }}</flux:navlist.item>
        </form>
    @else
        <flux:menu.item href="/login" icon="arrow-left-end-on-rectangle" wire:navigate>{{ __('Login') }}
        </flux:menu.item>
    @endif
</flux:navlist>
