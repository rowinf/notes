<?php

use App\Livewire\Notes\Archive;
use App\Livewire\Notes\Index;
use App\Models\Note;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Route::get('dashboard', Index::class)->name('dashboard');
    Route::get('dashboard/archive', Index::class)->name('archive');
    Route::get('dashboard/tags/{tag?}', Index::class)->name('tag');
    Route::get('dashboard/search', Index::class)->name('search');
    Route::get('dashboard?note={note}', Index::class)->name('dashboard.note');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
