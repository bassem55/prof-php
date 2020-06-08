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
    return view('welcome');
});
Route::get('/task' , 'tasks@index');

Route::get('/upload_task' , 'upload_task@index');
Route::post('/upload_task' , 'upload_task@upload_task');


Route::get('/tasks_result' , 'tasks_result@index');
Route::post('/tasks_result' , 'tasks_result@correction');

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/contact_us', function () {
    return view('contact_us');
});
Route::get('/about_us', function () {
    return view('about_us');
});