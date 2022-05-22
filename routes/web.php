<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

//post
Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('posts/{post:slug}', [PostController::class, 'show'])->name('posts.slug.show');

//comments
Route::post('/posts/{post:slug}/comments', [\App\Http\Controllers\PostCommentController::class, 'store']);

//mailchimp
Route::post('/newsletter', \App\Http\Controllers\NewsletterController::class);

//register
Route::get('/register', [\App\Http\Controllers\RegisterController::class, 'create'])->middleware('guest');
Route::post('/register/store', [\App\Http\Controllers\RegisterController::class, 'store'])->name('register.store')->middleware('guest');
//login
Route::get('login', [\App\Http\Controllers\SessionController::class, 'login'])->middleware('guest');
Route::post('sessions', [\App\Http\Controllers\SessionController::class, 'store'])->middleware('guest');
//logout
Route::post('logout', [\App\Http\Controllers\SessionController::class, 'destroy'])->middleware('auth');

//admin
Route::middleware('can:admin')->group(function () {
    Route::get('admin/posts', [AdminPostController::class, 'index'])->name('admin.posts');

    Route::get('admin/posts/create', [AdminPostController::class, 'create'])->name('admin.posts.create');
    Route::post('admin/posts', [AdminPostController::class, 'store'])->name('admin.posts.store');

    Route::get('admin/posts/{post}/edit', [AdminPostController::class, 'edit'])->name('admin.posts.edit');
    Route::patch('admin/posts/{post}', [AdminPostController::class, 'update'])->name('admin.posts.update');

    Route::delete('admin/posts/{post}', [AdminPostController::class, 'destroy'])->name('admin.posts.destroy');
});
