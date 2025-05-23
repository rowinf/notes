<nav id="mobile-nav" class="[grid-area:footer] flex dark:bg-zinc-950 bg-white justify-between items-end py-3 px-4 md:px-8 border-t lg:hidden">
    <div class="w-[14vw]">
        <a href="{{ route('note.index') }}" class="flex flex-col items-center px-4 py-1 rounded-md" wire:current="bg-blue-100 dark:bg-zinc-700 text-blue-500 fill-blue-500">
            <flux:icon.icon-home />
            <span class="hidden sm:block">Home</span>
        </a>
    </div>
    <flux:separator vertical class="hidden sm:block" />
    <div class="w-[14vw]">
        <a href="{{ route('search.index') }}" class="flex flex-col items-center px-4 py-1 rounded-md" wire:current="bg-blue-100 dark:bg-zinc-700 text-blue-500 fill-blue-500">
            <flux:icon.icon-search />
            <span class="hidden sm:block">Search</span>
        </a>
    </div>
    <flux:separator vertical class="hidden sm:block" />
    <div class="w-[14vw]">
        <a href="{{ route('archive.index') }}" class="flex flex-col items-center px-4 py-1 rounded-md" wire:current="bg-blue-100 dark:bg-zinc-700 text-blue-500 fill-blue-500">
            <flux:icon.icon-archive />
            <span class="hidden sm:block">Archived</span></a>
    </div>
    <flux:separator vertical class="hidden sm:block" />
    <div class="w-[14vw]">
        <a href="{{ route('tag.index') }}" class="flex flex-col items-center px-4 py-1 rounded-md" wire:current="bg-blue-100 dark:bg-zinc-700 text-blue-500 fill-blue-500">
            <flux:icon.icon-tag />
            <span class="hidden sm:block">Tags</span>
        </a>
    </div>
    <flux:separator vertical class="hidden sm:block" />
    <div class="w-[14vw]">
        <a href="{{ route('settings.index') }}" class="flex flex-col items-center px-4 py-1 rounded-md" wire:current="bg-blue-100 dark:bg-zinc-700 text-blue-500 fill-blue-500">
            <flux:icon.icon-settings />
            <span class="hidden sm:block">Settings</span>
        </a>
    </div>
</nav>
