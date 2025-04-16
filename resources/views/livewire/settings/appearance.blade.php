<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.settings')] class extends Component {
    public string $color_theme;

    public function mount()
    {
        $this->color_theme = Auth::user()->color_theme ?? 'system';
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
            $flux.appearance = event.color_theme;
            Alpine.store('toasts').toast("Settings updated successfully!");
        });
    </script>
@endscript

<x-settings.layout heading="{{ __('Color Theme') }}" subheading="{{ __('Choose your color theme:') }}">
    <form wire:submit="updateUser" class="flex flex-col pt-6 lg:max-w-[528px]">
        <flux:radio.group class="flex-col mb-6 space-y-8" wire:model="color_theme">
            <flux:field class="field-radio--card">
                <label>
                    <div>
                        <flux:icon.icon-sun />
                    </div>
                    <flux:description class="flex-1">
                        <div>Light Mode</div>
                        <div>Pick a clean and classic light theme</div>
                    </flux:description>
                    <flux:radio value="light" />
                </label>
            </flux:field>
            <flux:field class="field-radio--card">
                <label>
                    <div>
                        <flux:icon.icon-moon />
                    </div>
                    <flux:description class="flex-1">
                        <div>Dark Mode</div>
                        <div>Select a sleek and modern dark theme</div>
                    </flux:description>
                    <flux:radio value="dark" />
                </label>
            </flux:field>
            <flux:field class="field-radio--card">
                <label>
                    <div>
                        <flux:icon.icon-system-theme />
                    </div>
                    <flux:description class="flex-1">
                        <div>System</div>
                        <div>Adapts to your device's theme</div>
                    </flux:description>
                    <flux:radio value="system" checked="true" />
                </label>
            </flux:field>
        </flux:radio.group>
        <flux:button type="submit" variant="primary" class="self-end">Apply Changes</flux:button>
    </form>
</x-settings.layout>
