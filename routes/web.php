<?php

use App\Livewire\Archive;
use App\Livewire\Dashboard;
use App\Livewire\Notes\Index;
use App\Livewire\Tag;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::get('dashboard/archive', Archive::class)->name('archive');
    Route::get('dashboard/archive/notes/{note?}', Index::class)->name('archive.note');
    Route::get('dashboard/tags/{tag}', Tag::class)->name('tag');
    Route::get('dashboard/tags/{tag}/notes/{note?}', Index::class)->name('tag.note');
    Route::get('dashboard/tags/{tag}/notes/create', Index::class)->name('tag.create');
    Route::get('dashboard/search?query={searchQuery}', Index::class)->name('search');
    Route::get('dashboard/notes/create', Index::class)->name('dashboard.create');
    Route::get('dashboard/notes/{note}', Index::class)->name('dashboard.note');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
