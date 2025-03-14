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
    
    Route::prefix('dashboard')->group(function () {
        Route::get('archive', Archive::class)->name('archive');

        Route::get('archive/notes', Index::class)->name('archive.index');
        Route::get('archive/notes/{note?}', Index::class)->name('archive.show')->can('view', 'note');
        Route::get('tags/{tag}', Tag::class)->name('tag.show');
        Route::get('tags/{tag}/notes/{note?}', Index::class)->name('tag.note');
        Route::get('tags/{tag}/notes/create', Index::class)->name('tag.create');
        Route::get('notes', Index::class)->name('note.index');
        Route::get('notes/create', Index::class)->name('note.create');
        Route::get('notes/{note}', Index::class)->name('note.show')->can('view', 'note');
    });

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
