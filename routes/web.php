<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseUserController;
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


    //Inscription-Matirculation
    Route::get('/courses/{course}/add-teacher/{id}', [CourseUserController::class, 'showAddTeacherForm'])->name('courses.addTeacher');
    Route::post('/courses/{course}/add-teacher/{id}', [CourseUserController::class, 'addTeacher'])->name('courses.storeTeacher');


    Route::delete('/courses/{course}/remove-teacher/{teacher}', [CourseUserController::class, 'removeTeacher'])->name('courses.removeTeacher');

    Route::get('/courses/{course}/add-student/{id}', [CourseUserController::class, 'addStudentForm'])->name('courses.addStudentForm');
    Route::post('/courses/{course}/add-student/{id}', [CourseUserController::class, 'addStudent'])->name('courses.storeStudent');

    Route::delete('/courses/{course}/remove-student/{student}', [CourseUserController::class, 'removeStudent'])->name('courses.removeStudent');

    //Exams
    // routes/web.php

    Route::get('/exams', [ExamController::class, 'index'])->name('exams.index');
    Route::get('/exams', [ExamController::class, 'index'])->name('voyager.exams.index');
    Route::get('/course/{course}/create-exam', [ExamController::class, 'createExamForm'])->name('courses.create_exam_form');
    Route::post('/course/{course}/exams', [ExamController::class, 'storeExam'])->name('courses.store_exam');
    Route::get('/courses/{course}/exams/', [ExamController::class, 'showexam'])->name('exams.show');
    Route::get('/exams/{examId}/edit', 'ExamController@edit')->name('exams.edit');
    Route::put('/exams/{examId}', 'ExamController@update')->name('exams.update');
    Route::delete('/exams-destrot/{examId}', [ExamController::class, 'destroy'])->name('exams.destroy');


});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
