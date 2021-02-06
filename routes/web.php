<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;

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

Route::get('/posts', [PostController::class, 'index'])->name('postIndex');
Route::get('/post/create', [PostController::class, 'create'])->name('postCreate');
Route::post('/post', [PostController::class, 'store'])->name('postStore');
Route::get('/post/{post_id}', [PostController::class, 'show'])->name('postShow');
Route::get('/post/{post_id}}/edit', [PostController::class, 'edit'])->name('postEdit');
Route::put('/posts/update/{post_id}}', [PostController::class, 'update'])->name('postUpdate');
Route::delete('/posts/{post_id}}', [PostController::class, 'destroy'])->name('postDestroy');
Route::get('/posts/search', [PostController::class, 'search'])->name('postSearch');

Route::get('/', function () {
    return redirect('/posts');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return redirect('/posts');
})->name('dashboard');

Route::post('/like', [LikeController::class, 'store'])->name('likeStore');
Route::post('/deletelike', [LikeController::class, 'destroy'])->name('likeDestroy');

Route::post('/comment', [CommentController::class, 'store'])->name('commentStore');
Route::post('/deletecomment', [CommentController::class, 'destroy'])->name('commentDestroy');

Route::post('/favorite', [FavoriteController::class, 'store'])->name('favoriteStore');
Route::post('/deletefavorite', [FavoriteController::class, 'destroy'])->name('favoriteDestroy');