<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.settings')] class extends Component {
    public string $font_theme = '';

    public function mount()
    {
        $this->font_theme = Auth::user()->font_theme;
    }

    /**
     * Delete the currently authenticated user.
     */
    public function updateUser(): void
    {
        $attributes = $this->validate([
            'font_theme' => ['required', 'string'],
        ]);

        Auth::user()->update($attributes);
        $this->dispatch('refresh-page');
    }
}; ?>
@script
<script>
    $wire.on('refresh-page', (event) => {
        window.location.reload();
    });
</script>
@endscript
<section class="space-y-6">
    <x-settings.layout heading="{{ __('Font Theme') }}" subheading="{{ __('Choose your font theme:') }}">
        <form wire:submit="updateUser" class="flex flex-col items-end">
            <flux:radio.group wire:model="font_theme" class="flex-col mb-6">
                <flux:radio value="sans" label="Sans-serif" description="Clean and modern, easy to read" />
                <flux:radio value="serif" label="serif" description="Classic and elegant for a timeless feel." />
                <flux:radio value="mono" label="monospace" description="Code-like, great for a technical vibe." />
            </flux:radio.group>
            <flux:button type="submit" variant="primary">Apply Changes</flux:button>
        </form>
    </x-settings.layout>
</section>