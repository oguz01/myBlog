<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/createuserimage', function () {

$user = \App\Models\Image::find(2);
return $user->imageable;

});


Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('/yazi-detay', function () {
    return view('yazi-detay');
})->name('yazi-detay');

Route::get('/hakkimizda', function () {
    return view('hakkimizda');
})->name('hakkimizda');

Route::get('/iletisim', function () {
    return view('iletisim');
})->name('iletisim');

require __DIR__.'/auth.php';
