import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';

document.addEventListener('alpine:init', () => {
    console.log('init store toasts')
    Alpine.store('toasts', {
        message: '',
        isOpen: false,
        toast(msg) {
            if (msg) this.message = msg;
            this.isOpen = !!msg;
        }
    });
});

Livewire.on('note-removed', (event) => {
    Livewire.navigate('/dashboard/notes');
    Alpine.store('toasts').toast(event.message);
});

Livewire.on('note-added', (event) => {
    Livewire.navigate(`/dashboard/notes/${event.id}`);
    Alpine.store('toasts').toast(event.message);
});

Livewire.start();