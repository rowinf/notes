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
        $this->dispatch('font-updated', $attributes);
    }
}; ?>
@script
<script>
    $wire.on('font-updated', ([event]) => {
        document.body.style = `font-family: var(--font-${event.font_theme})`
        Alpine.store('toasts').toast("Settings updated successfully!");
    });
</script>
@endscript
<section class="mx-4 flex flex-col">
    <flux:button icon:leading="icon-chevron-right" variant="ghost" class="px-0! self-start lg:hidden"
        :href="route('settings.index')">Settings</flux:button>
    <x-settings.layout heading="{{ __('Font Theme') }}" subheading="{{ __('Choose your font theme:') }}">
        <form wire:submit="updateUser" class="flex flex-col pt-6 max-w-[528px]">
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
                        <flux:description class="flex-1">
                            <div>Serif</div>
                            <div>Classic and elegant for a timeless feel.</div>
                        </flux:description>
                        <flux:radio value="serif" />
                    </flux:label>
                </flux:field>
                <flux:field
                    class="border dark:has-[ui-radio[data-checked]]:bg-zinc-800 has-[ui-radio[data-checked]]:bg-zinc-50 rounded-xl">
                    <flux:label class="flex items-center gap-4 p-4">
                        <div class="border p-4 dark:bg-black rounded-xl bg-white">
                            <flux:icon.icon-font-monospace />
                        </div>
                        <flux:description class="flex-1">
                            <div>Mono</div>
                            <div>Code-like, great for a technical vibe.</div>
                        </flux:description>
                        <flux:radio value="mono" />
                    </flux:label>
                </flux:field>
            </flux:radio.group>
            <flux:button type="submit" variant="primary" class="self-end">Apply Changes</flux:button>
        </form>
    </x-settings.layout>
</section>