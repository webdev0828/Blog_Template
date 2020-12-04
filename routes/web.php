<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
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

Route::get('/', [PostController::class, 'home'])->name('index');
Route::get('/home', [PostController::class, 'home'])->name('home');
Route::post('/home', [PostController::class, 'home'])->name('home');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::group(['prefix' => 'auth'], function () {
  Auth::routes();
});

// check for logged in user
Route::middleware(['auth'])->group(function () {
  // show new post form
  Route::get('create', [PostController::class, 'create'])->name('create');
  // save new post
  Route::post('store', [PostController::class, 'store'])->name('store');
  // display user's all posts
  Route::get('my-all-posts', [UserController::class, 'user_posts_all'])->name('my-all-posts');
});
