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
            <flux:radio.group class="flex-col mb-6 space-y-8" wire:model="font_theme">
                <flux:field
                    class="border dark:has-[ui-radio[data-checked]]:bg-zinc-800 has-[ui-radio[data-checked]]:bg-zinc-50 rounded-xl">
                    <flux:label class="flex items-center gap-4 p-4">
                        <div class="border p-4 dark:bg-black rounded-xl bg-white">
                            <flux:icon.icon-font-sans-serif />
                        </div>
                        <flux:description class="flex-1">
                            <div>Sans-serif</div>
                            <div>Clean and modern, easy to read</div>
                        </flux:description>
                        <flux:radio value="sans" />
                    </flux:label>
                </flux:field>
                <flux:field
                    class="border dark:has-[ui-radio[data-checked]]:bg-zinc-800 has-[ui-radio[data-checked]]:bg-zinc-50 rounded-xl">
                    <flux:label class="flex items-center gap-4 p-4">
                        <div class="border p-4 dark:bg-black rounded-xl bg-white">
                            <flux:icon.icon-font-serif />
                        </div>
                        <flux:description>
                            <div>Serif</div>
                            <div>Classic and elegant for a timeless feel.</div>
                        </flux:description>
                        <flux:radio type="radio" value="serif" />
                    </flux:label>
                </flux:field>
                <flux:field
                    class="border dark:has-[ui-radio[data-checked]]:bg-zinc-800 has-[ui-radio[data-checked]]:bg-zinc-50 rounded-xl">
                    <flux:label class="flex items-center gap-4 p-4">
                        <div class="border p-4 dark:bg-black rounded-xl bg-white">
                            <flux:icon.icon-font-monospace />
                        </div>
                        <flux:description>
                            <div>Mono</div>
                            <div>Code-like, great for a technical vibe.</div>
                        </flux:description>
                        <flux:radio type="radio" value="mono" />
                    </flux:label>
                </flux:field>
            </flux:radio.group>
            <flux:button type="submit" variant="primary">Apply Changes</flux:button>
        </form>
    </x-settings.layout>
</section>