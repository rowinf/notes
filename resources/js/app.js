import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';

Livewire.on('note-removed', (event) => {
    Livewire.navigate('/dashboard/notes');
});

Livewire.on('note-added', (event) => {
    Livewire.navigate(`/dashboard/notes/${event.note.id}`);
});

Livewire.start()
