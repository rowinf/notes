<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.settings')] class extends Component {
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch(event: 'toast', message: "Password changed successfully!");
    }
}; ?>

<section class="mx-4 flex flex-col">
    <flux:button icon:leading="icon-chevron-right" variant="ghost" class="px-0! self-start lg:hidden"
        :href="route('settings.index')">Settings</flux:button>
    <x-settings.layout heading="{{ __('Change password') }}">
        <form wire:submit="updatePassword" class="flex flex-col mt-6 space-y-6 max-w-[528px]">
            <flux:input
                wire:model="current_password"
                id="update_password_current_passwordpassword"
                label="{{ __('Old password') }}"
                type="password"
                name="current_password"
                required
                autocomplete="current-password"
            />
            <flux:field>
                <flux:input
                    wire:model="password"
                    id="update_password_password"
                    label="{{ __('New password') }}"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                />
                <flux:description class="mt-0! flex gap-1 items-center"><flux:icon.icon-info class="size-5" /> At least 8 characters</flux:description>
            </flux:field>

            <flux:input
                wire:model="password_confirmation"
                id="update_password_password_confirmation"
                label="{{ __('Confirm New Password') }}"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
            />

            <flux:button variant="primary" type="submit" class="self-end">{{ __('Save Password') }}</flux:button>
            <div class="flex items-center gap-4">
                <x-action-message class="me-3" on="password-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>
    </x-settings.layout>
</section>
