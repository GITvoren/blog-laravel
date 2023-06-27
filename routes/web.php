<?php

use Illuminate\Support\Facades\Route;
/* use Illuminate\Support\Facades\Auth; */
use App\Http\Controllers\PostController;
use App\Models\Post;
use App\Models\PostComment;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $posts = Post::where('isActive', true)->get();
    return view('welcome')->with('posts', $posts);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/posts/create', [PostController::class, 'create']);

Route::post('/posts', [PostController::class, 'store']);

Route::get('/posts', [PostController::class, 'index']);

Route::get('/posts/{id}', [PostController::class, 'show']);

Route::get('/posts/{id}/edit', [PostController::class, 'edit']);

Route::put('/posts/{id}', [PostController::class, 'update']);

Route::delete('/posts/{id}', [PostController::class, 'archive']);

Route::put('/posts/{id}/like', [PostController::class, 'like']);

Route::post('/posts/{id}/comment', [PostController::class, 'comment']);

