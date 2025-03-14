<flux:navlist.group heading="Tags" class="grid">
    @foreach ($this->tags as $tag)
        <flux:navlist.item icon="tag" :href="route('tag.index', ['tag' => $tag])" :current="request()->route('tag')?->id === $tag->id" wire:key="{{$tag->id}}">
            {{ $tag->name }}
        </flux:navlist.item>
    @endforeach
</flux:navlist.group>