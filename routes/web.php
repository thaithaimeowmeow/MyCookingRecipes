<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Tag\Create;
use App\Livewire\Admin\Tag\Index;
use App\Livewire\Admin\Tag\Edit;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/admin/tag/', Index::class)->name('admin.tag.index');
Route::get('/admin/tag/{id}/edit', action: Edit::class)->name('admin.tag.edit');;
Route::get('/admin/tag/create', Create::class)->name('admin.tag.create');
Route::get('/admin/dashboard', Dashboard::class)->name('admin.dashboard');

require __DIR__.'/auth.php';
