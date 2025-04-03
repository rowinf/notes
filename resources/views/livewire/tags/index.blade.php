<flux:navlist.group heading="Tags">
    @foreach ($this->tags as $tag)
        <flux:navlist.item icon="icon-tag" :href="route('tag.show', ['tag' => $tag])" :current="request()->route('tag')?->id === $tag->id" wire:key="{{$tag->id}}">
            {{ $tag->name }}
        </flux:navlist.item>
    @endforeach
</flux:navlist.group>