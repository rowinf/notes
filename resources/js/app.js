import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import dialog from '@fylgja/alpinejs-dialog';

// Register any Alpine directives, components, or plugins here...
Alpine.plugin(dialog);

Livewire.start()
