<div data-note-sidebar @class(["lg:flex-[290px] lg:max-w-[290px] border-r overflow-y-auto", "hidden lg:block" => Route::is('note.show', 'archive.show', 'tag.note.show', 'note.create')])>
    {{ $slot }}
</div>
