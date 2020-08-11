<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->group(function () {
	Route::resource('Captcha', 'Restful\CaptchaController',['only' => ['index']]);
	Route::resource('Register', 'JwtAuth\RegisterController',['only' => ['store']]);
	Route::resource('Login', 'JwtAuth\LoginController',['only' => ['store']]);
    // Route::post('register', 'JwtAuth\RegisterController@register');
    // Route::post('login', 'AuthController@login');
    Route::get('refresh', 'AuthController@refresh');
    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('user', 'AuthController@user');
        Route::resource('Logout', 'JwtAuth\LogoutController',['only' => ['index']]);
    });
});