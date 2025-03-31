@php
    $archive = request()->routeIs('archive.index', 'archive.show');
@endphp
<livewire:note-list :active="!$archive" :archived="$archive"></livewire:note-list>
