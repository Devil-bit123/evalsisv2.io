<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoController;

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
    return view('welcome');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    Route::get('/add-view', [InfoController::class, 'go_to_view'])->name('info.view');
    Route::post('/add-info/{id}', [InfoController::class, 'store'])->name('info.add');
    Route::get('/info-edit/{id}', [InfoController::class, 'edit'])->name('info.edit');
    Route::any('/info-update/{id}', [InfoController::class, 'update'])->name('info.update');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
