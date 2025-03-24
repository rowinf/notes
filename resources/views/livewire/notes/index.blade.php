<div class="flex flex-1">
    <livewire:note-editor :note="$this->note" />
    @if ($this->note->id)
        <div class="border-l dark:border-zinc-600 border-zinc-200 py-5 px-4">
            <flux:navlist variant="outline">
                <flux:navlist.group>
                    @if ($this->note->is_archived)
                    <div x-data="{ open: false }">
                        <flux:navlist.item icon="archive-box-arrow-down" href="#" @click="open = !open"
                            wire:confirm="restore it?">
                            {{ __('Restore Note') }}
                        </flux:navlist.item>
                        <dialog x-show="open" x-htmldialog.noscroll="open = false">
                            Restore it?
                            <button wire:click>Restore!</button>
                        </dialog>
                    </div>
                    @else
                    <div x-data="{ open: false }">
                        <flux:navlist.item icon="archive-box-arrow-down" href="#" @click="open = !open">
                            {{ __('Archive Note') }}
                        </flux:navlist.item>
                        <dialog x-show="open" x-htmldialog.noscroll="open = false">
                            Archive it?
                            <flux:button wire:click="archive">Archive!</flux:button>
                        </dialog>
                    </div>
                    @endif
                    <flux:navlist.item icon="trash" href="#" wire:click="delete" wire:confirm="delete it?">
                        {{ __('Delete Note') }}
                    </flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>
        </div>
    @endif
</div>