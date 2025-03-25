<div class="flex flex-1">
    <livewire:note-editor :note="$this->note" />
    @if ($this->note->id)
        <div class="border-l py-5 px-4">
            <flux:navlist variant="outline">
                <flux:navlist.group>
                    @if ($this->note->is_archived)
                        <div x-data="{ open: false }">
                            <flux:navlist.item icon="archive-box-arrow-down" href="#" x-on:click="open = !open"
                                wire:confirm="restore it?">
                                {{ __('Restore Note') }}
                            </flux:navlist.item>
                            <dialog x-bind:open="open">
                                Restore it?
                                <flux:button wire:click="restore" variant="primary">Restore!</flux:button>
                                <flux:button x-on:click="open = !open">Cancel</flux:button>
                            </dialog>
                        </div>
                    @else
                        <div x-data="{ open: false }">
                            <flux:navlist.item icon="archive-box-arrow-down" href="#"
                                x-on:click="open = true; $nextTick(() => $refs.dialog.showModal())">
                                {{ __('Archive Note') }}
                            </flux:navlist.item>
                            @teleport('body')
                            <x-dialog>
                                <div class="border-b p-5 flex items-start gap-4">
                                    <div
                                        class="p-2 dark:bg-zinc-600 rounded-xl bg-white dark:border-zinc-600 border-zinc-100 block">
                                        <flux:icon.icon-archive class="size-6 color-white" />
                                    </div>
                                    <div>
                                        <h3 class="font-bold mb-1">Archive Note</h3>
                                        <p class="max-w-[40ch] text-sm">
                                            Are you sure you want to archive this note? You can find it in the Archived Notes
                                            section and restore it anytime.
                                        </p>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <flux:button x-on:click="$refs.dialog.close()">Cancel</flux:button>
                                    <flux:button x-on:click="$refs.dialog.close()" wire:click="archive" variant="primary">
                                        Archive Note</flux:button>
                                </div>
                            </x-dialog>
                            @endteleport
                        </div>
                    @endif
                    <div x-data="{ open: false }">
                        <flux:navlist.item icon="icon-delete" href="#"
                            x-on:click="open = true; $nextTick(() => $refs.dialog.showModal())">
                            {{ __('Delete Note') }}
                        </flux:navlist.item>
                        @teleport('body')
                        <x-dialog>
                            <div class="border-b p-5 flex items-start gap-4">
                                <div
                                    class="p-2 dark:bg-zinc-600 rounded-xl bg-white dark:border-zinc-600 border-zinc-100 block">
                                    <flux:icon.icon-delete class="size-6 color-white" />
                                </div>
                                <div>
                                    <h3 class="font-bold mb-1">Delete Note</h3>
                                    <p class="max-w-[40ch] text-sm">
                                        Are you sure you want to permanently delete this note? This action cannot be undone.
                                    </p>
                                </div>
                            </div>
                            <div class="p-4">
                                <flux:button x-on:click="$refs.dialog.close()">Cancel</flux:button>
                                <flux:button x-on:click="$refs.dialog.close()" wire:click="delete" variant="danger">
                                    Delete Note</flux:button>
                            </div>
                        </x-dialog>
                    </div>
                </flux:navlist.group>
            </flux:navlist>
        </div>
    @endif
</div>