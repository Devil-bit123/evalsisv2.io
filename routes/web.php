<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserCompanyController;

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

    //Informacion
    Route::get('/add-view', [InfoController::class, 'go_to_view'])->name('info.view');
    Route::post('/add-info/{id}', [InfoController::class, 'store'])->name('info.add');
    Route::get('/info-edit/{id}', [InfoController::class, 'edit'])->name('info.edit');
    Route::any('/info-update/{id}', [InfoController::class, 'update'])->name('info.update');

    //Contrato de maestros
    Route::post('/inscription-store/{id}', [UserCompanyController::class, 'store'])->name('inscription.store');
    Route::get('/remove-user-from-company/{userId}/{companyId}', [UserCompanyController::class, 'removeUserFromCompany'])
    ->name('remove.user.from.company');

    //Cursos

    Route::get('/index-course', [CourseController::class, 'index'])
    ->name('courses.index');

    Route::post('/create-course', [CourseController::class, 'store'])
    ->name('courses.store');

    Route::get('/edit-course/{id}', [CourseController::class, 'edit'])
    ->name('courses.edit');

    Route::put('/update-course/{id}', [CourseController::class, 'update'])
    ->name('courses.update');

    Route::any('/delete-course/{id}', [CourseController::class, 'destroy'])
    ->name('courses.delete');

    Route::any('/add-course', [CourseController::class, 'add'])
    ->name('courses.add');

    Route::get('/details-course/{id}', [CourseController::class, 'details'])
    ->name('courses.details');







});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
