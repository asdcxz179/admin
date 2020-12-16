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
	Route::resource('Login', 'JwtAuth\LoginController',['only' => ['store']]);
    Route::group(['middleware' => [
                                    'auth:api',
                                    \App\Http\Middleware\ApiPermission::class,
                                    ]], function(){
        Route::resource('Check', 'JwtAuth\CheckController',['only' => ['index']]);
        Route::resource('Route', 'Restful\RouteController',['only' => ['index']]);
        Route::resource('Permission', 'Restful\PermissionController',['only' => ['index','update']]);

        Route::resource('Register', 'JwtAuth\RegisterController',['only' => ['store']]);
        Route::resource('ChangePassword', 'JwtAuth\ChangePasswordController',['only' => ['update']]);
        Route::get('user', 'AuthController@user');
        Route::resource('Refresh', 'JwtAuth\RefreshController',['only' => ['index']]);
        Route::resource('Logout', 'JwtAuth\LogoutController',['only' => ['index']]);
        Route::resource('ManagerGroup', 'Restful\GroupController',['only' => ['index','show','store','update']]);
        Route::resource('ManagerRole', 'Restful\RoleController',['only' => ['index','show','store','update']]);
        Route::resource('Managers', 'Restful\ManagerController',['only' => ['index','show','update']]);
        Route::resource('DisableManager', 'Restful\DisableManagerController',['only' => ['update']]);
        Route::resource('Dashboard', 'Restful\DashboardController',['only' => ['index']]);
        Route::resource('Settings', 'Restful\SettingsController',['only' => ['index']]);

        
    });
});