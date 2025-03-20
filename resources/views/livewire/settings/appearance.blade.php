<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.settings')] class extends Component {

    public string $color_theme = '';

    public function mount()
    {
        $this->color_theme = Auth::user()->color_theme;
    }

    /**
     * Delete the currently authenticated user.
     */
    public function updateUser(): void
    {
        $attributes = $this->validate([
            'color_theme' => ['required', 'string'],
        ]);

        Auth::user()->update($attributes);
        $this->dispatch('update-appearance', $attributes);
    }
}; ?>
@script
<script>
    $wire.on('update-appearance', ([event]) => {
        Flux.appearance = event.color_theme;
    });
</script>
@endscript
<div class="flex flex-col items-start">

    <x-settings.layout heading="{{ __('Color Theme') }}" subheading="{{ __('Choose your color theme:') }}">
        <form wire:submit="updateUser" class="flex flex-col items-end">
            <flux:radio.group class="flex-col mb-6 space-y-8" wire:model="color_theme">
                <flux:field
                    class="border dark:has-[ui-radio[data-checked]]:bg-zinc-800 dark:border-zinc-600 has-[ui-radio[data-checked]]:bg-zinc-50 rounded-xl">
                    <flux:label class="flex items-center gap-4 p-4">
                        <div class="border p-4 dark:bg-black rounded-xl bg-white dark:border-zinc-600 border-zinc-100">
                            <flux:icon.icon-font-sans-serif />
                        </div>
                        <flux:description class="flex-1">
                            <div>Light Mode</div>
                            <div>Pick a clean and classic light theme</div>
                        </flux:description>
                        <flux:radio value="light" />
                    </flux:label>
                </flux:field>
                <flux:field
                    class="border dark:has-[ui-radio[data-checked]]:bg-zinc-800 dark:border-zinc-600 has-[ui-radio[data-checked]]:bg-zinc-50 rounded-xl">
                    <flux:label class="flex items-center gap-4 p-4">
                        <div class="border p-4 dark:bg-black rounded-xl bg-white dark:border-zinc-600 border-zinc-100">
                            <flux:icon.icon-font-serif />
                        </div>
                        <flux:description>
                            <div>Dark Mode</div>
                            <div>Select a sleek and modern dark theme</div>
                        </flux:description>
                        <flux:radio type="radio" value="dark" />
                    </flux:label>
                </flux:field>
                <flux:field
                    class="border dark:has-[ui-radio[data-checked]]:bg-zinc-800 dark:border-zinc-600 has-[ui-radio[data-checked]]:bg-zinc-50 rounded-xl">
                    <flux:label class="flex items-center gap-4 p-4">
                        <div class="border p-4 dark:bg-black rounded-xl bg-white dark:border-zinc-600 border-zinc-100">
                            <flux:icon.icon-font-monospace />
                        </div>
                        <flux:description>
                            <div>System</div>
                            <div>Adapts to your device's theme</div>
                        </flux:description>
                        <flux:radio type="radio" value="system" />
                    </flux:label>
                </flux:field>
            </flux:radio.group>
            <flux:button type="submit" variant="primary">Apply Changes</flux:button>
        </form>
    </x-settings.layout>
</div>