<x-layouts.app>
    <div>
        <div class="flex h-full w-full flex-1 gap-1 rounded-xl flex-col">
            <flux:button class="w-full">Add Note</flux:button>
            <livewire:notes.index />
        </div>
        <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
            <div id="editor"></div>
        </div>
    </div>
</x-layouts.app>