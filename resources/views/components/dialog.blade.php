<dialog {{ $attributes }} class="border m-auto rounded-xl"  x-ref="dialog" x-on:close="open = false">
    {{ $slot }}
</dialog>