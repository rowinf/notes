<x-layouts.app.sidebar title="Tags">
    @include('partials.page-heading', ['heading' => "Tags"])
    <flux:main>
        <flux:heading size="xl" level="1" @class(["lg:hidden border-r pt-5 px-8 [grid-area:innerheader]"])>
            Tags
        </flux:heading>
        {{ $slot }}
    </flux:main>
</x-layouts.app.sidebar>