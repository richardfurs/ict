<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Middleware\CheckPostOwnership;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/posts');
});

Route::get('/posts', [PostController::class, 'index'])->name('posts');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('create');
    Route::patch('/posts/{id}', [PostController::class, 'update']);
    Route::post('/posts/delete/{id}', [PostController::class, 'destroy']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::post('/posts/{id}/comments/add', [CommentController::class, 'store']);
    Route::delete('/posts/comments/{id}/delete', [CommentController::class, 'destroy']);
});

Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->middleware(CheckPostOwnership::class);

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::post('/search', [PostController::class, 'search']);