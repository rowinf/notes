import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';

document.addEventListener('alpine:init', function () {
    Alpine.store('toasts', {
        message: '',
        isOpen: false,
        deferOpen: false,
        init() {
            // bind this to call from `livewire:navigated` event
            this.deferToast = (msg) => {
                this.deferOpen = true;
                this.message = msg;
            }
            this.toast = (msg) => {
                if (msg) this.message = msg;
                this.isOpen = !!msg;
                this.deferOpen = false;
            }
        },
    });
});

document.addEventListener('livewire:navigated', () => {
    const { deferOpen, message, toast } = Alpine.store('toasts');
    if (deferOpen) {
        toast(message);
    }
});

Livewire.on('note-removed', async (event) => {
    Alpine.store('toasts').deferToast(event.message);
});

Livewire.on('note-added', (event) => {
    Alpine.store('toasts').deferToast(event.message);
});

Livewire.on('toast', (event) => {
    Alpine.store('toasts').toast(event.message);
});

Livewire.start();