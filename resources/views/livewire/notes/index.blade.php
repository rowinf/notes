<div class="flex flex-1">
    <livewire:note-editor :note="$this->note" />
    @if ($this->note->id)
        <div class="border-l dark:border-zinc-600 border-zinc-200 py-5 px-4">
            <flux:navlist variant="outline">
                <flux:navlist.group>
                    <flux:navlist.item icon="archive-box-arrow-down" href="#" wire:click="archive"
                        wire:confirm="archive it?">
                        {{ __('Archive Note') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="trash" href="#" wire:click="delete" wire:confirm="delete it?">
                        {{ __('Delete Note') }}
                    </flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>
        </div>
    @endif
</div>