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
Route::get('/' , function(){
    return redirect()->route('index');
});
Route::get('posts/index' , 'PostController@index')->name('index');
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

Route::match(['get','post'],'share' , 'HomeController@share')->name('share');
Route::get('/share/{select_year}/{school_code}' , 'HomeController@share_one')->name('share_one');
Route::match(['get','post'],'excellent' , 'HomeController@excellent')->name('excellent');

//已登入者可連
Route::group(['middleware'=>'auth'],function(){
//登入後導向的頁面
    Route::get('home', function(){
        if(auth()->user()->group_id=="9"){
            return redirect()->route('users.index');
        }
    });

    //通知
    Route::get('notify' , 'HomeController@notify')->name('notify');
    Route::get('notify_read/{message}' , 'HomeController@notify_read')->name('notify_read');
    Route::patch('email_store' , 'HomeController@email_store')->name('email_store');
    Route::get('callback', 'HomeController@callback')->name('callback');
    Route::get('cancel', 'HomeController@cancel')->name('cancel');

    Route::post('message' , 'HomeController@message')->name('message');
    Route::post('message_store' , 'HomeController@message_store')->name('message_store');

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
    Route::post('users/search' , 'UserController@search')->name('users.search');

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

    //普教審查管理
    Route::match(['get','post'],'reviews' , 'ReviewController@index')->name('reviews.index');
    Route::get('reviews/{select_year}/{school_code}/first_user' , 'ReviewController@first_user')->name('reviews.first_user');
    Route::post('reviews/first_user_store' , 'ReviewController@first_user_store')->name('reviews.first_user_store');
    Route::get('reviews/{select_year}/{school_code}/second_user' , 'ReviewController@second_user')->name('reviews.second_user');
    Route::post('reviews/second_user_store' , 'ReviewController@second_user_store')->name('reviews.second_user_store');
    Route::get('reviews/{course}/first_review_delete' , 'ReviewController@first_review_delete')->name('reviews.first_review_delete');
    Route::get('reviews/{course}/second_review_delete' , 'ReviewController@second_review_delete')->name('reviews.second_review_delete');

    //依委員選學校
    Route::get('reviews/{select_year}/first_by_user' , 'ReviewController@first_by_user')->name('reviews.first_by_user');
    Route::post('reviews/first_by_user_store' , 'ReviewController@first_by_user_store')->name('reviews.first_by_user_store');
    Route::get('reviews/{select_year}/second_by_user' , 'ReviewController@second_by_user')->name('reviews.second_by_user');
    Route::post('reviews/second_by_user_store' , 'ReviewController@second_by_user_store')->name('reviews.second_by_user_store');

    //開放
    Route::get('reviews/{select_year}/{school_code}/select_open' , 'ReviewController@select_open')->name('reviews.select_open');
    Route::get('reviews/{select_year}/{school_code}/select_close' , 'ReviewController@select_close')->name('reviews.select_close');
    Route::get('reviews/{select_year}/open' , 'ReviewController@open')->name('reviews.open');
    Route::get('reviews/{select_year}/close' , 'ReviewController@close')->name('reviews.close');

    //特教審查管理
    Route::match(['get','post'],'reviews/index2' , 'ReviewController@index2')->name('reviews.index2');

    Route::get('reviews/{question}/{select_year}/{school_code}/special_user' , 'ReviewController@special_user')->name('reviews.special_user');
    Route::post('reviews/special_user_store' , 'ReviewController@special_user_store')->name('reviews.special_user_store');
    Route::get('reviews/{special_review}/special_review_delete' , 'ReviewController@special_review_delete')->name('reviews.special_review_delete');
    /**
    Route::get('reviews/{select_year}/{school_code}/special1_user' , 'ReviewController@special1_user')->name('reviews.special1_user');
    Route::post('reviews/special1_user_store' , 'ReviewController@special1_user_store')->name('reviews.special1_user_store');
    Route::get('reviews/{select_year}/{school_code}/special2_user' , 'ReviewController@special2_user')->name('reviews.special2_user');
    Route::post('reviews/special2_user_store' , 'ReviewController@special2_user_store')->name('reviews.special2_user_store');
    Route::get('reviews/{select_year}/{school_code}/special3_user' , 'ReviewController@special3_user')->name('reviews.special3_user');
    Route::post('reviews/special3_user_store' , 'ReviewController@special3_user_store')->name('reviews.special3_user_store');
     * */

    //依委員選學校
    Route::get('reviews/{select_year}/special_by_user/{question}' , 'ReviewController@special_by_user')->name('reviews.special_by_user');
    //Route::get('reviews/{select_year}/special_by_user/{special}' , 'ReviewController@special_by_user')->name('reviews.special_by_user');
    Route::post('reviews/special_by_user_store' , 'ReviewController@special_by_user_store')->name('reviews.special_by_user_store');

    //未送名單
    Route::get('reviews/{result}/{select_year}/not_send' , 'ReviewController@not_send')->name('reviews.not_send');
    Route::get('reviews/{course}/{page}/{action}/back_null' , 'ReviewController@back_null')->name('reviews.back_null');
    Route::get('show_special/{select_year}' , 'ReviewController@show_special')->name('reviews.show_special');

    //匯出表單
    Route::match(['get','post'],'exports/index' , 'ExportController@index')->name('exports.index');
    Route::get('exports/{select_year}/section' , 'ExportController@section')->name('exports.section');
    Route::get('exports/{select_year}/show_date' , 'ExportController@show_date')->name('exports.show_date');

});

//學校可用
Route::group(['middleware' => 'school'],function(){
    //顯示動作log
    Route::get('schools/{year}/logs','SchoolController@show_log')->name('schools.show_log');

    Route::match(['get','post'],'schools' , 'SchoolController@index')->name('schools.index');
    Route::get('schools/edit/{select_year}' , 'SchoolController@edit')->name('schools.edit');
    Route::get('schools/edit2/{select_year}' , 'SchoolController@edit')->name('schools.edit2');
    Route::get('schools/{select_year}/upload1/{question}' , 'SchoolController@upload1')->name('schools.upload1');
    Route::post('schools/save1' , 'SchoolController@save1')->name('schools.save1');
    Route::get('schools/{file_path}/delete1' , 'SchoolController@delete1')->name('schools.delete1');
    Route::get('schools/{select_year}/upload2/{question}' , 'SchoolController@upload2')->name('schools.upload2');
    Route::post('schools/save2' , 'SchoolController@save2')->name('schools.save2');
    Route::get('schools/{file_path}/delete2' , 'SchoolController@delete2')->name('schools.delete2');
    Route::get('schools/{select_year}/upload3/{question}' , 'SchoolController@upload3')->name('schools.upload3');
    Route::post('schools/save3' , 'SchoolController@save3')->name('schools.save3');
    Route::get('schools/{upload}/delete3' , 'SchoolController@delete3')->name('schools.delete3');
    Route::get('schools/{select_year}/upload4/{question}/{grade}/{subject}' , 'SchoolController@upload4')->name('schools.upload4');
    Route::post('schools/save4' , 'SchoolController@save4')->name('schools.save4');
    Route::get('schools/{file_path}/delete4/{grade}/{subject}' , 'SchoolController@delete4')->name('schools.delete4');
    Route::get('schools/{select_year}/upload5/{question}' , 'SchoolController@upload5')->name('schools.upload5');
    Route::post('schools/save5' , 'SchoolController@save5')->name('schools.save5');
    Route::get('schools/{upload}/delete5' , 'SchoolController@delete5')->name('schools.delete5');
    Route::get('schools/{select_year}/upload6/{question}/{stu_year}' , 'SchoolController@upload6')->name('schools.upload6');
    Route::post('schools/save6' , 'SchoolController@save6')->name('schools.save6');
    Route::get('schools/{file_path}/delete6/{stu_year}' , 'SchoolController@delete6')->name('schools.delete6');
    Route::get('schools/{select_year}/upload7/{question}/{stu_year}' , 'SchoolController@upload7')->name('schools.upload7');
    Route::post('schools/save7' , 'SchoolController@save7')->name('schools.save7');
    Route::get('schools/{file_path}/delete7/{stu_year}' , 'SchoolController@delete7')->name('schools.delete7');
    Route::get('schools/{select_year}/upload8/{question}' , 'SchoolController@upload8')->name('schools.upload8');
    Route::post('schools/save8' , 'SchoolController@save8')->name('schools.save8');
    Route::get('schools/{upload}/delete8' , 'SchoolController@delete8')->name('schools.delete8');

    Route::post('schools/submit' , 'SchoolController@submit')->name('schools.submit');

    Route::get('schools/{select_year}/show_special' , 'SchoolController@show_special')->name('schools.show_special');
    Route::get('schools/{select_year}/show_all' , 'SchoolController@show_all')->name('schools.show_all');

    //列印
    Route::get('schools/{upload}/print' , 'SchoolController@print')->name('schools.print');
});

//初審委員
Route::group(['middleware' => 'first'],function(){
    Route::get('home', function(){
        if(auth()->user()->group_id=="4"){
            return redirect()->route('firsts.index');
        }
    });
    Route::match(['get','post'],'firsts/index' , 'FirstController@index')->name('firsts.index');
    //Route::get('firsts/{course}/show' , 'FirstController@show')->name('firsts.show');
    Route::get('firsts/{course}/create1' , 'FirstController@create1')->name('firsts.create1');
    Route::post('firsts/store1' , 'FirstController@store1')->name('firsts.store1');
    Route::get('firsts/{course}/edit1' , 'FirstController@edit1')->name('firsts.edit1');
    Route::post('firsts/update1' , 'FirstController@update1')->name('firsts.update1');

    Route::get('firsts/{course}/create2' , 'FirstController@create2')->name('firsts.create2');
    Route::post('firsts/store2' , 'FirstController@store2')->name('firsts.store2');
    Route::get('firsts/{course}/edit2' , 'FirstController@edit2')->name('firsts.edit2');
    Route::post('firsts/update2' , 'FirstController@update2')->name('firsts.update2');

    Route::get('firsts/{course}/create3' , 'FirstController@create3')->name('firsts.create3');
    Route::post('firsts/store3' , 'FirstController@store3')->name('firsts.store3');
    Route::get('firsts/{course}/edit3' , 'FirstController@edit3')->name('firsts.edit3');
    Route::post('firsts/update3' , 'FirstController@update3')->name('firsts.update3');
});

//複審委員
Route::group(['middleware' => 'second'],function(){
    Route::get('home', function(){
        if(auth()->user()->group_id=="5"){
            return redirect()->route('seconds.index');
        }
    });
    Route::match(['get','post'],'seconds/index' , 'SecondController@index')->name('seconds.index');
    Route::get('seconds/{course}/create' , 'SecondController@create')->name('seconds.create');
    Route::patch('seconds/update' , 'SecondController@update')->name('seconds.update');
});

//特教委員
Route::group(['middleware' => 'special'],function(){
    Route::get('home', function(){
        if(auth()->user()->group_id=="3"){
            return redirect()->route('special.index');
        }
    });
    Route::match(['get','post'],'specials/index' , 'SpecialController@index')->name('specials.index');
    Route::get('specials/{special_review}/create' , 'SpecialController@create')->name('specials.create');
    Route::post('specials/store' , 'SpecialController@store')->name('specials.store');

});
