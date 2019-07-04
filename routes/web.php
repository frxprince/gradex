<?php

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
    return redirect('/home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/scoreboard','ScoreboardController');
Route::resource('/submission','SubmissionController');
Route::get('/submission/{problem_id}/{schedule_id}','SubmissionController@showproblem');
Route::get('classroom','ScoreboardController@classroom');
Route::get('/changePassword','HomeController@showChangePasswordForm');
Route::post('/changePassword','HomeController@changePassword')->name('changePassword');
Route::resource('/info','InfoController');
Route::resource('/admin','AdminController');

Route::get('/adminPage/addnewclassroom', function () {
    return view('admin.addclassroom');
});

Route::get('/adminPage/addnewproblem', function () {
    return view('admin.addproblem');
});

Route::get('/adminPage/addstudent','AdminController@addstudent');
Route::get('/adminPage/addnewtestcase','AdminController@addtestcase');
Route::get('/adminAjax/getTestcaseCount','AdminController@testcase_get_count');
Route::get('/adminAjax/updateTestcase','AdminController@testcase_set_add');

Route::get('/adminPage/addnewschedule','AdminController@addschedule');
Route::get('/adminAjax/schedule_get_from_classroom','AdminController@schedule_get_from_classroom');
Route::get('/adminAjax/schedule_manage/{id}','AdminController@schedule_manage');
Route::get('/adminPage/add_new_task_to_schedule/{id}','AdminController@schedule_add');
//Route::get('/admin/addclassroom/{id}','AdminController');
