<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    // get all post
    $posts = DB::table('bulletinBoard')->get();

    return view('homepage', [
        "posts" => $posts,
    ]);
});

Route::get('/home', 'HomeController@index');



/*
 * administrator dashboard
 */
Route::group(['prefix' => 'administrator', 'middleware' => 'CheckAdmin'], function () {
    // 申請案管理
    Route::get('/application', 'adminApplicationController@showAllApplication');


    // 基數與學費設定
    Route::get('/capSetting', 'adminCapSettingController@showCurrentSetting');


    // 帳號管理
    Route::get('/accountManagement', 'adminAccountController@showAllAccount');


    // 公布欄
    Route::get('/bulletinBoard', 'adminBulletinBoardController@showAllPost');
    Route::post('/bulletinBoard', 'adminBulletinBoardController@addPost');


    // 系統申請狀態設定
    // Route::get('/statusSetting', 'HomeController@statusSetting');
});

/*
 * reviewer dashboard
 */
Route::group(['prefix' => 'reviewer', 'middleware' => 'CheckReviewer'], function () {

});

/*
 * student applicant dashboard
 */
Route::group(['prefix' => 'student', 'middleware' => 'CheckStudent'], function () {
    // 學生申請表
    Route::get('/applicationForm', 'studentApplicationController@showApplicationForm');
});



/*
 * User login, register, logout, and forget password routes are defined below
 */

// Auth::routes(); // Illuminate/Routing/Router
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

