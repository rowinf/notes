<?php

namespace App\Livewire;

use App\Livewire\Notes\Index;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

#[Layout('components.layouts.search')]
class SearchResults extends Index
{
    #[Url]
    public string $searchTerm = '';
}
