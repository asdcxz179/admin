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

Route::get('/Admin', function () {
    return view('admin');
});
Route::get('/', function () {
    return view('front');
});


// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home.index');


Route::resource('WebInfo', 'Client\WebInfoController',['only' => ['index']]);

Route::resource('WebContent', 'Client\WebContentController',['only' => ['index']]);

Route::resource('Experience', 'Client\ExperienceController',['only' => ['index']]);

Route::resource('Contact', 'Client\ContactController',['only' => ['store']]);

use Illuminate\Http\Request;

Route::get('/Token', function (Request $request) {
    $token = $request->session()->token();

    $token = csrf_token();
    return $token;
});