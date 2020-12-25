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
    /* 後台驗證碼 */
	Route::resource('Captcha', 'Restful\CaptchaController',['only' => ['index']]);
    /* 管理員登入 */
	Route::resource('Login', 'JwtAuth\LoginController',['only' => ['store']]);
    Route::group(['middleware' => [
                                    'auth:api',
                                    ]], function(){ 
        /* 檢查是否登入 */
        Route::resource('Check', 'JwtAuth\CheckController',['only' => ['index']]);
        /* 後台左側選單 */
        Route::resource('Route', 'Restful\RouteController',['only' => ['index']]);
        /* 權限列表 */
        Route::resource('Permission', 'Restful\PermissionController',['only' => ['index','update']]);
        /* 更改密碼 */
        Route::resource('ChangePassword', 'JwtAuth\ChangePasswordController',['only' => ['update']]);
        /* 管理員登出 */
        Route::resource('Logout', 'JwtAuth\LogoutController',['only' => ['index']]);
        /* 刷新token */
        Route::resource('Refresh', 'JwtAuth\RefreshController',['only' => ['index']]);

        Route::group(['middleware'=>[
                                        \App\Http\Middleware\ApiPermission::class,
                                    ]],function(){
            /* 管理員註冊 */
            Route::resource('Register', 'JwtAuth\RegisterController',['only' => ['store']]);
            /* 管理員群組 */
            Route::resource('ManagerGroup', 'Restful\GroupController',['only' => ['index','show','store','update']]);
            /* 管理員角色 */
            Route::resource('ManagerRole', 'Restful\RoleController',['only' => ['index','show','store','update']]);
            /* 管理員列表 */
            Route::resource('Managers', 'Restful\ManagerController',['only' => ['index','show','update']]);
            /* 停用管理員 */
            Route::resource('DisableManager', 'Restful\DisableManagerController',['only' => ['update']]);
            /* 儀表版 */
            Route::resource('Dashboard', 'Restful\DashboardController',['only' => ['index']]);
            /* 系統設定 */
            Route::resource('Settings', 'Restful\SettingsController',['only' => ['index','update']]);
            /* 系統設定 */
            Route::resource('Experience', 'Restful\ExperienceController',['only' => ['index','update','show','store','destroy']]);
        });
    });
});