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
    return view('index');
})->name('index');

//Auth::routes();
//上列包含了下列十條路由
#登入
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');

//gsuite登入
Route::get('glogin', 'GLoginController@showLoginForm')->name('glogin');
Route::post('glogin', 'GLoginController@auth')->name('gauth');

#登出
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

#註冊
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//Route::post('register', 'Auth\RegisterController@register')->name('register.post');

#忘記密碼
//Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//Route::post('password/reset', 'Auth\ResetPasswordController@reset');
//Route::get('/home', 'HomeController@index')->name('home');


//已登入者可連
Route::group(['middleware'=>'auth'],function(){
//登入後導向的頁面
    Route::get('home', function(){
        if(auth()->user()->group_id=="9"){
            return redirect()->route('users.index');
        }
    });

    //更改個人密碼
    Route::get('resetPwd' , 'HomeController@reset_pwd')->name('reset_pwd');
    Route::patch('updatePWD' , 'HomeController@update_pwd')->name('update_pwd');
});


//管理者可連
Route::group(['middleware'=>'admin'],function(){
    //使用者管理
    Route::match(['get','post'],'users/index' , 'UserController@index')->name('users.index');
    Route::get('users/{group_id}/create' , 'UserController@create')->name('users.create');
    Route::post('users/store' , 'UserController@store')->name('users.store');
    Route::get('users/{user}/edit' , 'UserController@edit')->name('users.edit');
    Route::patch('users/{user}/update' , 'UserController@update')->name('users.update');
    Route::patch('users/{user}/disable' , 'UserController@disable')->name('users.disable');
    Route::patch('users/{user}/able' , 'UserController@able')->name('users.able');
    Route::get('users/{user}/reset' , 'UserController@reset')->name('users.reset');
});

