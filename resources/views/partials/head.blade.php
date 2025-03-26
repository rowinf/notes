@php
    $resources = ['resources/css/app.css', 'resources/js/app.js'];
@endphp
@livewireScriptConfig
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="A beautiful demo note taking application, for a project portfolio, based on a design by front end mentor.">
<meta name="author" content="Robert Irwin (rowinf)">
<meta name="keywords" content="HTML, CSS, JavaScript, PHP, Laravel, Livewire, Demo, Notes, Front end mentor">
<title>{{ $title ?? 'Notes' }}</title>
<link rel="icon" type="image/png" href="/assets/images/favicon-32x32.png">

@vite($resources)
@fluxAppearance
@livewireStyles