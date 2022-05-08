<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/yazi-detay/{post:slug}', [\App\Http\Controllers\PostController::class, 'show'])->name('posts.show');
Route::post('/yazi-detay/{post:slug}', [\App\Http\Controllers\PostController::class, 'addComment'])->name('posts.add_comment');
Route::get('/hakkimizda', \App\Http\Controllers\AboutController::class)->name('hakkimizda');
Route::get('/iletisim', [\App\Http\Controllers\ContactController::class, 'create'])->name('iletisim');
Route::post('/iletisim', [\App\Http\Controllers\ContactController::class, 'store'])->name('iletisim.store');

Route::get('/kategori/{category:slug}', [\App\Http\Controllers\CategoryController::class, 'show'])->name('category.show');
Route::get('/etiket/{tag:slug}', [\App\Http\Controllers\Tag::class, 'show'])->name('tags.show');

require __DIR__ . '/auth.php';
