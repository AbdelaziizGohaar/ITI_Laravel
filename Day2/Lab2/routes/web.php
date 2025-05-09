<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\IndexController;
// use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::resource('posts',IndexController::class);


Route::get('/posts', [IndexController::class, 'index'])->name('posts.index');

Route::get('/posts/create', [IndexController::class, 'create'])->name('posts.create');

Route::get('/posts/{id}', [IndexController::class, 'show'])->name('posts.show');

Route::post('/posts', [IndexController::class, 'store'])->name('posts.store');

Route::get('/posts/{id}/edit', [IndexController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{id}', [IndexController::class, 'update'])->name('posts.update');

Route::delete('/posts/{id}', [IndexController::class, 'destroy'])->name('posts.destroy');



Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

// require __DIR__.'/auth.php';