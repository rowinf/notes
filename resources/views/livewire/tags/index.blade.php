<flux:navlist.group heading="Tags" class="grid">
    @foreach ($this->tags as $tag)
    <flux:navlist.item icon="tag" :href="route('tag', $tag)" :current="request()->routeIs('tag')  && request()->route('tag')->id === $tag->id"
        wire:navigate>{{ $tag->name }}</flux:navlist.item>
    @endforeach
</flux:navlist.group>