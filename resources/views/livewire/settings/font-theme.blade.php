<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.settings')] class extends Component {
    public string $font_theme = '';

    public function mount() {
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
    <x-settings.layout heading="{{ __('Font Theme') }}" subheading="{{ __('Update your font') }}">

        <div>
            {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
            Font Theme
            <form wire:submit="updateUser">
                <flux:radio.group wire:model="font_theme" label="Select your font theme">
                    <flux:radio value="sans" label="Sans-serif" />
                    <flux:radio value="serif" label="serif" />
                    <flux:radio value="mono" label="monospace" />
                </flux:radio.group>
                <flux:button type="submit" variant="primary">Apply Changes</flux:button>
            </form>
        </div>
    </x-settings.layout>
</section>