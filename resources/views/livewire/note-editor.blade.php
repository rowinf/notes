<form wire:submit="update" class="flex flex-2/3 flex-col px-6 py-5">
    <div class="grid text-sm">
        <div x-data="{open: false}">
            <button class="text-2xl font-bold text-left cursor-pointer mb-2" type="button" x-on:click="open = !open"
                x-text="$wire.form.title" x-show="!open"></button>
            <flux:field x-show="open" x-cloak>
                <flux:input type="text" wire:model="form.title" placeholder="Title" x-on:blur="open = false" x-trap="open" />
            </flux:field>
        </div>
        <div class="flex mb-1" x-data="{open: false}">
            <div class="flex w-36 items-center mb-1">
                <flux:icon.tag class="size-4 mr-1" /><span class="align-baseline">Tags</span>
            </div>
            <button @class(["text-left cursor-pointer", 'text-white' => filled($form->tags), 'text-zinc-400' => !filled($form->tags)]) type="button" x-on:click="open = !open" x-text="$wire.form.tags || 'Add tags separated by commas (e.g. Work, Planning)'"
                x-show="!open"></button>
            <flux:field class="flex-1" x-show="open" x-cloak>
                <flux:input type="text" wire:model.blur="form.tags" placeholder="Tags" x-on:blur="open = false" x-trap="open"
                    size="xs" />
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

    <flux:textarea class="flex-1 min-h-min" wire:model="form.content">
    </flux:textarea>
    <flux:separator class="my-4" />
    <div>
        <flux:button type="submit" variant="primary" class="disabled:opacity-75 mr-2" wire:dirty.class="bg-blue-900">
            Save Note
        </flux:button>
        <flux:button href="{{ route('note.index') }}">Cancel</flux:button>
    </div>
</form>