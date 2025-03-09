<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

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


Route::middleware(['web'])->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/create', \App\Livewire\Post\Create::class)->name('create');
        Route::get('/recipe/{slug}/edit', \App\Livewire\Post\Edit::class)->name('post.edit');

        Route::get('/user/{username}/edit', \App\Livewire\Profile\Edit::class)->name('user.edit');
        Route::group(['middleware' => 'admin'], function () {
            
        });
        
        Route::get('/admin/tag/', \App\Livewire\Admin\Tag\Index::class)->middleware(IsAdmin::class)->name('admin.tag.index');
        Route::get('/admin/tag/{id}/edit', \App\Livewire\Admin\Tag\Edit::class)->middleware(IsAdmin::class)->name('admin.tag.edit');
        Route::get('/admin/tag/create', \App\Livewire\Admin\Tag\Create::class)->middleware(IsAdmin::class)->name('admin.tag.create');
        Route::get('/admin/user/', \App\Livewire\Admin\User\Index::class)->middleware(IsAdmin::class)->name('admin.user.index');
        Route::get('/admin/user/{username}/view', \App\Livewire\Admin\User\View::class)->middleware(IsAdmin::class)->name('admin.user.view');
        Route::get('/recipe/{slug}/preview', \App\Livewire\Post\Preview::class)->middleware(IsAdmin::class)->name('post.preview');

        Route::get('/admin/dashboard', \App\Livewire\Admin\Dashboard::class)->middleware(IsAdmin::class)->name('admin.dashboard');
    });

    Route::get('/', \App\Livewire\Homepage::class)->name('home');
    Route::get('/browse', \App\Livewire\Browse::class)->name('browse');
    Route::get('/recipe/{slug}', \App\Livewire\Post\Index::class)->name('post.index');
    Route::get('/user/{username}', \App\Livewire\Profile\Index::class)->name('user.index');

    require __DIR__ . '/auth.php';
});



// Route::get('/', action: App\Livewire\Homepage::class)->name('home');
// Route::get('/recipe/{slug}', action: App\Livewire\Post\Index::class)->name('post.index');
// Route::get('/create', action: App\Livewire\Post\Create::class)->name('create');
// Route::get('/user/{username}', action: App\Livewire\Profile\Index::class)->name('user.index');



// Route::get('/admin/tag/', action: App\Livewire\Admin\Tag\Index::class)->name('admin.tag.index');
// Route::get('/admin/tag/{id}/edit', action: App\Livewire\Admin\Tag\Edit::class)->name('admin.tag.edit');;
// Route::get('/admin/tag/create', App\Livewire\Admin\Tag\Create::class)->name('admin.tag.create');

// Route::get('/admin/user/', action: App\Livewire\Admin\User\Index::class)->name('admin.user.index');
// Route::get('/admin/user/{username}/view', action: App\Livewire\Admin\User\View::class)->name('admin.user.view');


// Route::get('/admin/dashboard', Dashboard::class)->name('admin.dashboard');
