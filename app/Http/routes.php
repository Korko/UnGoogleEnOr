<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/play', 'GameController@random');
Route::get('/play/{slug}', 'GameController@play')->name('play');

Route::get('/admin/', function () {
    $questions = App\Question::with('answers')->get();
    return view('admin/list', ['questions' => $questions]);
});
Route::get('/admin/add', function () {
    JavaScript::put(['csrf' => csrf_token()]);
    return view('admin/add');
});
Route::get('/admin/answers', 'AdminController@getAnswers');
Route::post('/admin/question', 'AdminController@doAddQuestion');
Route::delete('/admin/question', 'AdminController@doDeleteQuestion');
