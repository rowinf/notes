<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.settings')] class extends Component {
    public string $password = '';

    /**
     * Delete the currently authenticated user.
     */
    public function updateUser(): void
    {
        $attributes = $this->validate([
            'font_theme' => ['required', 'string'],
        ]);

        Auth::user()->update($attributes);
    }
}; ?>

<section class="space-y-6">
    <x-settings.layout heading="{{ __('Font Theme') }}" subheading="{{ __('Update your font') }}">

        <div>
            {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
            Font Theme
            <form wire:submit="updateUser">
                <input type="radio" wire:model="font_theme" value="sans"> sans
                <input type="radio" wire:model="font_theme" value="serif"> serif
                <input type="radio" wire:model="font_theme" value="mono"> mono
                <input type="submit">
            </form>
        </div>
    </x-settings.layout>
</section>