<dialog {{ $attributes }} class="border top-[30vh] mx-auto rounded-xl"  x-ref="dialog" x-on:close="open = false">
    {{ $slot }}
</dialog>