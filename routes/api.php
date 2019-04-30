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




Route::post('/register', 'UserController@register');

Route::post('/login', 'UserController@login');

Route::group(['middleware'=>'token'],function(){
    // token刷新
    // Route::post('/updateToken', 'ApiTokenController@updateToken');
    // 用户列表
    Route::get('/userList','UserController@userList');
    Route::get('/userInfo','UserController@userInfo');
    //  function(Request $request) {
    //     return $request->user();
    // });
});
