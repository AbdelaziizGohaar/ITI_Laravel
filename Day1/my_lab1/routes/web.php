<?php

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

require __DIR__.'/auth.php';