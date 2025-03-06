<flux:navlist.group heading="Tags" class="grid">
    @foreach ($this->tags as $tag)
        <flux:navlist.item icon="tag" :href="route('tag', ['tag' => $tag])" :current="request()->routeIs('tag.note') && request()->route('tag')->id === $tag->id" wire:navigate wire:key="{{$tag->id}}">
            {{ $tag->name }}
        </flux:navlist.item>
    @endforeach
</flux:navlist.group>