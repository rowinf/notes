<form wire:submit="submit" class="flex">
    <flux:input wire:model="searchTerm" type="search" required
        placeholder="{{ __('Search by title, content, or tags...') }}" />
</form>