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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('index');

Route::get('/grade', 'AlumnoGrupoController@index')->name('nivel');
Route::post('/set-grade', 'AlumnoGrupoController@setGrade')->name('set.grade');

Route::group([ 'middleware' => ['auth_teacher'],
                'prefix' => 'teacher' ], function () {

    Route::get('/', 'TeacherDashboardController@index')->name('teacher.index');
    Route::get('/groups', 'TeacherDashboardController@groups')->name('teacher.groups');
    Route::get('/groups/get-students', 'GrupoController@getStudents');
    
    Route::get('/subjects', 'TeacherDashboardController@subjects')->name('teacher.subjects');
    Route::get('/subjects/get', 'MateriaController@getSubjects');
    Route::post('/subjects/new', 'MateriaController@newSubjects');

    Route::get('/task', 'TeacherDashboardController@task')->name('teacher.task');
    Route::get('/task/get', 'TareaController@getTask');
    Route::post('/task/new', 'TareaController@newTask');

    Route::get('/subject-task/get/{pk_tarea}', 'MateriaController@getSubjectTasks');

});


Route::group([ 'middleware' => ['auth_student'],
                'prefix' => 'student' ], function () {

    Route::get('/', 'StudentDashboardController@index')->name('student.index');

    Route::get('/task', 'StudentDashboardController@task')->name('student.task');
    Route::get('/task/get', 'TareaController@getTask');
    Route::get('/subject/{materia}/task/{tarea}', 'TareaController@viewTask')->name('student.view');
    Route::get('/task/submit/{pk_tarea}', 'TareaController@submitTask');
    Route::post('/task/submit/save', 'AlumnoTareaController@saveTaskResource')->name('studen.task.save');
    Route::get('/task/get-resources', 'AlumnoTareaController@getStudentResources');

});
