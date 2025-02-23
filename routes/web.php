<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Dashboard;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/', action: App\Livewire\Homepage::class)->name('home');
Route::get('/recipe/{slug}', action: App\Livewire\Post\Index::class)->name('post.index');


Route::get('/admin/tag/', action: App\Livewire\Admin\Tag\Index::class)->name('admin.tag.index');
Route::get('/admin/tag/{id}/edit', action: App\Livewire\Admin\Tag\Edit::class)->name('admin.tag.edit');;
Route::get('/admin/tag/create', App\Livewire\Admin\Tag\Create::class)->name('admin.tag.create');

Route::get('/admin/user/', action: App\Livewire\Admin\User\Index::class)->name('admin.user.index');
Route::get('/admin/user/{username}/view', action: App\Livewire\Admin\User\View::class)->name('admin.user.view');


Route::get('/admin/dashboard', Dashboard::class)->name('admin.dashboard');

require __DIR__.'/auth.php';
