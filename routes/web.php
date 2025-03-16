<?php

use App\Livewire\Archive;
use App\Livewire\Dashboard;
use App\Livewire\NoteEditor;
use App\Livewire\NoteEmpty;
use App\Livewire\Notes\Index;
use App\Livewire\SearchResults;
use App\Livewire\TagNoteEmpty;
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

        Route::get('archive/notes', NoteEmpty::class)->name('archive.index');
        Route::get('archive/notes/{note}', Index::class)->name('archive.show')->can('view', 'note');
        Route::get('tags/{tag}', TagNoteEmpty::class)->name('tag.index');
        Route::get('tags/{tag}/notes/{note}', NoteEditor::class)->name('tag.show');
        Route::get('tags/{tag}/notes/create', NoteEditor::class)->name('tag.create');
        Route::get('notes', NoteEmpty::class)->name('note.index');
        Route::get('notes/create', Index::class)->name('note.create');
        Route::get('notes/{note}', Index::class)->name('note.show')->can('view', 'note');
        Route::get('search/notes', SearchResults::class)->name('search.index');
    });

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
