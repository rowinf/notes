@if (Route::is('archive.index'))
    <span>Archived Notes</span>
@elseif (Route::is('tag.show'))
    <span class="text-zinc-600 dark:text-zinc-300">Notes tagged:</span> <span>{{ request('tag')->name }}</span>
@elseif (Route::is('search.index'))
    <span class="text-zinc-600 dark:text-zinc-300">Showing results for:</span> <span>{{request('searchTerm')}}</span>
@else
    <span>All Notes</span>
@endif