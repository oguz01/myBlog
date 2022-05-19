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

Route::get('/kategori/', [\App\Http\Controllers\CategoryController::class, 'index'])->name('category.index');
Route::get('/kategori/{category:slug}', [\App\Http\Controllers\CategoryController::class, 'show'])->name('category.show');
Route::get('/etiket/{tag:name}', [\App\Http\Controllers\TagController::class, 'show'])->name('tags.show');

require __DIR__ . '/auth.php';

/**=========== Admin Dashboard =====**/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'IsAdmin'])->group(function () {
    Route::get('/', [\App\Http\Controllers\AdminController\DashboardController::class, 'index'])->name('index');
    Route::resource('/posts', \App\Http\Controllers\AdminController\AdminPostController::class);
    Route::post('upload_tinymce_image', [\App\Http\Controllers\AdminController\TinyMCEController::class, 'upload_tinymce_image'])->name('upload_tinymce_image');
});
