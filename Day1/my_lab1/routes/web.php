<?php

use App\Http\Controllers\IndexController;
// use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/posts', [IndexController::class, 'index'])->name('posts.index');

Route::get('/posts/create', [IndexController::class, 'create'])->name('posts.create');
Route::post('/posts', [IndexController::class, 'store'])->name('posts.store');

Route::get('/posts/{post}/edit', [IndexController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{post}', [IndexController::class, 'update'])->name('posts.update');

Route::get('/posts/{post}', [IndexController::class, 'show'])->name('posts.show');

Route::delete('/posts/{post}', [IndexController::class, 'destroy'])->name('posts.destroy');

require __DIR__.'/auth.php';