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

    // get semester in use
    $in_use = DB::table('systemStatus')->where('in_use', '=', '1')->get()->first();

    return view('homepage', [
        "posts" => $posts,
        "in_use" => $in_use,
    ]);
});

Route::get('/home', 'HomeController@index');


/*
 * administrator dashboard
 */
Route::group(['prefix' => 'administrator', 'middleware' => 'CheckAdmin'], function () {
    // 申請案管理
    Route::get('/application', 'adminApplicationController@showAllApplication');
    Route::post('/application', 'adminApplicationController@updateAllApplication');


    // 基數與學費設定
    Route::get('/capSetting', 'adminCapSettingController@showCurrentSetting');
    Route::post('/capSetting', 'adminCapSettingController@updateCurrentSetting');

    // 帳號管理
    Route::get('/accountManagement', 'adminAccountController@showAllAccount');              // 觀看所有帳號
    Route::get('/accountManagement/edit/{id}', 'adminAccountController@editAccount');       // 更新帳戶資料
    Route::post('/accountManagement/edit/success', 'adminAccountController@updateAccount'); // 更新帳戶資料
    Route::get('/accountManagement/delete/{id}', 'adminAccountController@deleteAccount');   // 刪除帳號
    Route::get('/accountManagement/createAccount','adminAccountController@createAccount');  // 建立帳戶
    Route::post('/accountManagement/create/success', 'adminAccountController@Creating');    // 建立帳戶
    Route::get('/accountManagement/createAccountForFaculties', 'adminAccountController@createAccountForFaculties');    // 建立院辦系辦帳戶


    // 公布欄
    Route::get('/bulletinBoard', 'adminBulletinBoardController@showAllPost');
    Route::post('/bulletinBoard', 'adminBulletinBoardController@addPost');
    Route::get('/bulletinBoard/edit/{id}', 'adminBulletinBoardController@editPost');
    Route::get('/bulletinBoard/delete/{id}', 'adminBulletinBoardController@deletePost');

    // 系統申請狀態設定
    Route::get('/statusSetting', 'adminStatusController@showStatusSettings');
    Route::post('/systemStatus/setSemester', 'adminStatusController@setSemester');
    Route::post('/systemStatus/setTimeline', 'adminStatusController@setTimeline');

    // 系所設定
    Route::get('/facultyManagement', 'adminFacultyController@showAllFaculty');
    Route::post('/facultyManagement/setCollege', 'adminFacultyController@setDepartmentCollege');


    // 學期設定等等相關操作
    Route::get('/statusSetting/editSemester/{id}', 'adminStatusController@editSemester');
    Route::post('/systemStatus/semester', 'adminStatusController@addSemester');
});

/*
 * reviewer dashboard
 */
Route::group(['prefix' => 'reviewer', 'middleware' => 'CheckReviewer'], function () {
    // 申請案管理
    Route::get('/application', 'reviewerApplicationController@showAllApplication');
    Route::post('/application', 'reviewerApplicationController@updateAllApplication');
});

/*
 * student applicant dashboard
 */
Route::group(['prefix' => 'student', 'middleware' => 'CheckStudent'], function () {
    // 學生申請表
    Route::get('/applicationForm', 'studentApplicationController@showApplicationForm');
    Route::post('/applicationForm', 'studentApplicationController@addApplicationForm');
    Route::post('/applicationForm/readRule', 'studentApplicationController@readRule');
    Route::post('/applicationForm/addStudentID', 'studentApplicationController@addStudentID');

    // Result
    Route::get('/applicationResult', 'studentApplicationController@showApplicationResult');
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
