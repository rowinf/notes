<div x-data="{ deleteDialogOpen: true, archiveDialogOpen: false }"
    class="note-editor flex-1 grid lg:grid-flow-col grid-rows-[min-content_1fr] lg:grid-rows-1 lg:grid-cols-[auto_min-content]">
    <div class="lg:hidden px-6 pt-3">
        <div class="flex items-center">
            <flux:button href="{{ route($backroute, request()->query()) }}" inset size="sm" icon:variant="micro"
                variant="subtle" icon:leading="icon-chevron-right" class="-ml-4" wire:navigate>Go Back
            </flux:button>
            <flux:spacer />

            <flux:button variant="subtle" icon="icon-delete" icon:variant="micro" size="sm"
                x-on:click="deleteDialogOpen = true; $nextTick(() => $refs.deleteDialog.showModal())">
            </flux:button>
            @if ($this->form->note->is_archived)
                <flux:button variant="subtle" icon:variant="micro" icon="icon-restore" icon:variant="micro"
                    size="sm" wire:click="restoreNote"></flux:button>
            @else
                <flux:button variant="subtle" icon="icon-archive" icon:variant="micro" size="sm"
                    x-on:click="archiveDialogOpen = true; $nextTick(() => $refs.archiveDialog.showModal())">
                </flux:button>
            @endif
            <flux:button href="{{ route('note.index') }}" size="sm" variant="subtle">Cancel</flux:button>
            <flux:button type="submit" form="note-form" size="sm" variant="ghost"
                class="lg:hidden mr-0! pr-0 text-blue-500!">
                Save Note
            </flux:button>
        </div>
        <flux:separator class="mt-1" />
    </div>
    <form id="note-form" wire:submit="update" class="flex px-6 py-5 flex-1 flex-col">
        <div class="grid text-sm">
            <div x-data="{ open: false, isValid: true, toggleInput() { this.open = !this.open; $focus.next(); } }">
                <button class="text-2xl font-bold text-left cursor-pointer mb-2" type="button"
                    x-on:click="toggleInput()" x-text="$wire.form.title" x-show="!open"></button>
                <flux:field x-show="open" x-cloak x-data="{emitTitle (title) { open = !title; $wire.dispatch('title-updated.{{ $note->id ?? '-1' }}', {title}) } }">
                    <flux:input required autocomplete="off" type="text" wire:model="form.title" placeholder="Title"
                        x-on:blur="emitTitle($el.value); isValid = $el.checkValidity()"
                        x-on:keydown.tab="emitTitle($el.value)"
                        x-on:keydown.enter="emitTitle($el.value)"
                        x-on:focus="$el.select()"
                        x-bind:aria-invalid="isValid ? false : true" />
                </flux:field>
            </div>
            <div class="flex mb-1" x-data="{ open: false, toggleInput() { this.open = !this.open; $focus.next(); }}">
                <div class="flex w-36 items-center mb-1">
                    <flux:icon.tag class="size-4 mr-1" /><span class="align-baseline">Tags</span>
                </div>
                <button @class([
                    'text-left cursor-pointer',
                    'dark:text-white' => filled($form->tags),
                    'text-zinc-400' => !filled($form->tags),
                ]) type="button" x-on:click="toggleInput()"
                    x-text="$wire.form.tags || 'Add tags separated by commas (e.g. Work, Planning)'"
                    x-show="!open"></button>
                <flux:field class="flex-1" x-show="open" x-cloak>
                    <flux:input type="text" wire:model.blur="form.tags" placeholder="Tags"
                        x-on:blur="open = false"
                        x-on:keydown.enter="$el.blur()"
                        x-on:focus="$el.select()" size="xs" />
                </flux:field>
            </div>
            @if ($this->form->is_archived)
                <div class="flex mb-1">
                    <div class="flex w-36 mb-1">
                        <flux:icon.icon-status class="size-4 mr-1" /> Status
                    </div>
                    <div>
                        Archived
                    </div>
                </div>
            @endif
            <div class="flex">
                <div class="flex w-36">
                    <flux:icon.clock class="size-4 mr-1" /><span class="align-baseline">Last Edited</span>
                </div>
                <p @class(['text-left', 'text-zinc-400' => !$this->form->last_edited_at])>
                    {{ $this->form->last_edited_at ?? 'Not yet saved' }}
                </p>
            </div>
        </div>
        <flux:separator class="my-4" />

        <flux:textarea class="flex-1 min-h-min bg-transparent!" wire:model="form.content"
            placeholder="Start typing your note here...">
        </flux:textarea>
        <flux:separator class="my-4 hidden lg:block" />
        <div class="hidden lg:block">
            <flux:button type="submit" variant="primary" class="disabled:opacity-75 mr-2">
                Save Note
            </flux:button>
            <flux:button href="{{ route('note.index') }}" variant="filled" class="text-zinc-600! dark:text-zinc-400!">
                Cancel
            </flux:button>
        </div>
    </form>
    @if ($this->form->note->id)
        <div class="flex-0 border-l py-5 px-4 hidden lg:flex flex-col gap-3">
            @if ($this->note->is_archived)
                <flux:button icon="icon-restore" class="w-full bg-transparent!" icon:variant="micro"
                    wire:click="restoreNote" class="bg-transparent!">
                    {{ __('Restore Note') }}
                </flux:button>
            @else
                <flux:button icon="icon-archive" class="w-full bg-transparent!"
                    x-on:click="archiveDialogOpen = true; $nextTick(() => $refs.archiveDialog.showModal())">
                    {{ __('Archive Note') }}
                </flux:button>
            @endif
            <flux:button icon="icon-delete" class="w-full bg-transparent!"
                x-on:click="deleteDialogOpen = true; $nextTick(() => $refs.deleteDialog.showModal())">
                {{ __('Delete Note') }}
            </flux:button>
        </div>
    @endif

    @teleport('#dialogs')
        <x-dialog x-ref="archiveDialog" x-on:close="archiveDialogOpen = false">
            <x-dialog.icon>
                <flux:icon.icon-archive class="size-6 color-white" />
            </x-dialog.icon>
            <x-dialog.body>
                <h3 class="font-bold mb-1">Archive Note</h3>
                <p class="max-w-[40ch] text-sm text-zinc-700 dark:text-white">
                    Are you sure you want to archive this note? You can find it in the Archived Notes
                    section and restore it anytime.
                </p>
            </x-dialog.body>
            <x-dialog.footer>
                <flux:button x-on:click="$refs.archiveDialog.close()" variant="filled"
                    class="dark:bg-zinc-500! text-zinc-600! dark:text-white!">Cancel</flux:button>
                <flux:button x-on:click="$refs.archiveDialog.close()" wire:click="archive" variant="primary">
                    Archive Note
                </flux:button>
            </x-dialog.footer>
        </x-dialog>
    @endteleport
    @teleport('#dialogs')
        <x-dialog x-ref="deleteDialog" x-on:close="deleteDialogOpen = false">
            <x-dialog.icon>
                <flux:icon.icon-delete class="size-6 color-white" />
            </x-dialog.icon>
            <x-dialog.body>
                <h3 class="font-bold mb-1">Delete Note</h3>
                <p class="max-w-[40ch] text-sm text-zinc-700 dark:text-white">
                    Are you sure you want to permanently delete this note? This action cannot be undone.
                </p>
            </x-dialog.body>
            <x-dialog.footer>
                <flux:button x-on:click="$refs.deleteDialog.close()" variant="filled"
                    class="dark:bg-zinc-500! text-zinc-600! dark:text-white!">Cancel</flux:button>
                <flux:button x-on:click="$refs.deleteDialog.close()" wire:click="delete" variant="danger">
                    Delete Note
                </flux:button>
            </x-dialog.footer>
        </x-dialog>
    @endteleport
</div>
