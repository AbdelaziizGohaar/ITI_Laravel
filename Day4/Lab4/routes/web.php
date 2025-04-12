<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

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

 require __DIR__.'/auth.php';


 Route::get("/tokens/create", function(Request $request){
    $token = $request->user()->createToken("test");
    // dd($token);
    return [
        'token' => $token->plainTextToken
    ];
});