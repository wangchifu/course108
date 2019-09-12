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

//首頁
Route::get('/' , 'PostController@index')->name('index');
//公告內容
Route::get('/posts/show/{post}' , 'PostController@show')->name('posts.show');
//下載storage裡public的檔案
Route::get('file/{file}', 'FileController@getFile');

//打開課程計畫的檔案
Route::get('schools/{file_path}/open' , 'FileController@open')->name('schools.open');
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

    //結束模擬
    Route::get('sims/impersonate_leave', 'SimulationController@impersonate_leave')->name('sims.impersonate_leave');
});


//管理者可連
Route::group(['middleware'=>'admin'],function(){
    //公告系統
    Route::get('posts/create' , 'PostController@create')->name('posts.create');
    Route::post('posts' , 'PostController@store')->name('posts.store');
    Route::get('posts/{post}/edit' , 'PostController@edit')->name('posts.edit');
    Route::patch('posts/{post}' , 'PostController@update')->name('posts.update');
    Route::delete('posts/{post}', 'PostController@destroy')->name('posts.destroy');
    //刪檔案
    Route::get('posts/{file}/fileDel' , 'PostController@fileDel')->name('posts.fileDel');

    //使用者管理
    Route::match(['get','post'],'users/index' , 'UserController@index')->name('users.index');
    Route::get('users/{group_id}/create' , 'UserController@create')->name('users.create');
    Route::post('users/store' , 'UserController@store')->name('users.store');
    Route::get('users/{user}/edit' , 'UserController@edit')->name('users.edit');
    Route::patch('users/{user}/update' , 'UserController@update')->name('users.update');
    Route::patch('users/{user}/disable' , 'UserController@disable')->name('users.disable');
    Route::patch('users/{user}/able' , 'UserController@able')->name('users.able');
    Route::get('users/{user}/reset' , 'UserController@reset')->name('users.reset');

    //模擬登入
    Route::get('sims/{user}/impersonate', 'SimulationController@impersonate')->name('sims.impersonate');

    //年度管理
    Route::get('years/index' , 'YearController@index')->name('years.index');
    Route::get('years/{year}/show' , 'YearController@show')->name('years.show');
    Route::get('years/create' , 'YearController@create')->name('years.create');
    Route::post('years/store' , 'YearController@store')->name('years.store');
    Route::get('years/{year}/edit' , 'YearController@edit')->name('years.edit');
    Route::patch('years/{year}/update' , 'YearController@update')->name('years.update');
    Route::get('years/{year}/destroy' , 'YearController@destroy')->name('years.destroy');

    //題目管理
    Route::match(['get','post'],'questions' , 'QuestionController@index')->name('questions.index');
    Route::post('questions/store_part' , 'QuestionController@store_part')->name('questions.store_part');
    Route::post('questions/store_topic' , 'QuestionController@store_topic')->name('questions.store_topic');
    Route::post('questions/store_question' , 'QuestionController@store_question')->name('questions.store_question');
    Route::get('questions/delete_part/{part}' , 'QuestionController@delete_part')->name('questions.delete_part');
    Route::get('questions/delete_topic/{topic}' , 'QuestionController@delete_topic')->name('questions.delete_topic');
    Route::get('questions/delete_question/{question}' , 'QuestionController@delete_question')->name('questions.delete_question');
    Route::get('questions/edit_part/{select_year}/{part}' , 'QuestionController@edit_part')->name('questions.edit_part');
    Route::get('questions/edit_topic/{select_year}/{topic}' , 'QuestionController@edit_topic')->name('questions.edit_topic');
    Route::get('questions/edit_question/{select_year}/{question}' , 'QuestionController@edit_question')->name('questions.edit_question');
    Route::post('questions/{part}/update_part' , 'QuestionController@update_part')->name('questions.update_part');
    Route::post('questions/{topic}/update_topic' , 'QuestionController@update_topic')->name('questions.update_topic');
    Route::post('questions/{question}/update_question' , 'QuestionController@update_question')->name('questions.update_question');
    Route::post('questions/copy' , 'QuestionController@copy')->name('questions.copy');

    //教科書版本管理
    Route::get('books/index' , 'BookController@index')->name('books.index');
    Route::post('books/store' , 'BookController@store')->name('books.store');
    Route::delete('books/destroy' , 'BookController@destroy')->name('books.destroy');
});

//學校可用
Route::group(['middleware' => 'school'],function(){
    //顯示動作log
    Route::get('schools/{year}/logs','SchoolController@show_log')->name('schools.show_log');

    Route::match(['get','post'],'schools' , 'SchoolController@index')->name('schools.index');
    Route::get('schools/edit/{select_year}' , 'SchoolController@edit')->name('schools.edit');
    Route::get('schools/{select_year}/upload1/{question}' , 'SchoolController@upload1')->name('schools.upload1');
    Route::post('schools/save1' , 'SchoolController@save1')->name('schools.save1');
    Route::get('schools/{file_path}/delete1' , 'SchoolController@delete1')->name('schools.delete1');
    Route::get('schools/{select_year}/upload2/{question}' , 'SchoolController@upload2')->name('schools.upload2');
    Route::post('schools/save2' , 'SchoolController@save2')->name('schools.save2');
    Route::get('schools/{file_path}/delete2' , 'SchoolController@delete2')->name('schools.delete2');
    Route::get('schools/{select_year}/upload8/{question}' , 'SchoolController@upload8')->name('schools.upload8');
    Route::post('schools/save8' , 'SchoolController@save8')->name('schools.save8');
    Route::get('schools/{upload}/delete8' , 'SchoolController@delete8')->name('schools.delete8');
});
