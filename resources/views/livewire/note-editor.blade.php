<form wire:submit="update" class="flex flex-2/3 flex-col px-6 py-5">
    <div class="grid"> 
        <div x-data="{open: false}">
            <button class="text-2xl font-bold text-left cursor-pointer mb-2" type="button" x-on:click="open = !open"
                x-text="$wire.form.title" x-show="!open"></button>
            <flux:field x-show="open" x-cloak>
                <flux:input type="text" wire:model="form.title" placeholder="Title" x-on:blur="open = false" x-trap="open" />
            </flux:field>
        </div>
        <div class="flex items-center mb-1" x-data="{open: false}">
            <div class="w-50 flex items-center mb-1">
                <flux:icon.tag class="size-4" /><span class="ml-1 text-sm align-baseline">Tags <span wire:dirty="form.tags">*</span></span>
            </div>
            <button @class(["text-sm text-left cursor-pointer", 'text-white' => filled($form->tags), 'text-zinc-400' => !filled($form->tags)]) type="button" x-on:click="open = !open" x-text="$wire.form.tags || ' tags, etc'"
                x-show="!open"></button>
            <flux:field x-show="open" x-cloak>
                <flux:input type="text" wire:model.blur="form.tags" placeholder="Tags" x-on:blur="open = false" x-trap="open"
                    size="xs" />
            </flux:field>
        </div>
        <div class="flex items-center">
            <div class="flex items-center w-50">
                <flux:icon.clock class="size-4" /><span class="ml-1 text-sm align-baseline">Last Edited</span>
            </div>
            <p class="text-left text-sm">
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