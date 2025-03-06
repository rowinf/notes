<div id="note-content" class="space-y-4">
    <p class="text-2xl">{{ $note->title }}</p>
    <dl class="space-y-4">
        <dt>Tags</dt>
        <dd>
            @foreach ($note->tags as $tag)
                <span>{{ $tag->name }}</span>
            @endforeach
        </dd>
        <dt>Last edited</dt>
        <dd>{{ $note->last_edited_at }}</dd>
    </dl>
    @markdown($note->content)
</div>