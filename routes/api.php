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
Route::post('register', 'APIs\AuthController@register');
Route::post('login-account', 'APIs\AuthController@loginAccount');
Route::post('login-user-name', 'APIs\AuthController@loginUserName');
Route::post('login-phone', 'APIs\AuthController@loginPhone');
Route::post('login-social', 'APIs\AuthController@loginSocial');
Route::post('check-phone', 'APIs\AuthController@checkPhone');
Route::post('forgot-password', 'APIs\AuthController@forgotPassword');
// Hỗ trợ
Route::apiResource('introduces', 'APIs\IntroduceController');
Route::apiResource('support', 'APIs\SupportController');
Route::post('get-code', 'APIs\CodeController@getCode');
Route::get('list-code', 'APIs\CodeController@index');
Route::get('list-code-status', 'APIs\CodeController@listCodeStatus');
Route::post('insert-code-by-number', 'APIs\CodeController@insertCodeByNumber');
//    Tư vấn viên
Route::get('list-counselor', 'APIs\CounselorController@index');
Route::get('counselor-detail', 'APIs\CounselorController@show');
Route::group(['middleware' => ['jwt.auth.token']], function () {
//    Route::apiResource('news', 'APIs\NewsController');
    Route::apiResource('posts', 'APIs\PostController');
    Route::apiResource('counselors', 'APIs\PostController');
    Route::apiResource('banks', 'APIs\BankController');
    Route::get('list-post-favorite', 'APIs\PostController@listPostFavorite');
    Route::post('action-post-favorite', 'APIs\PostController@actionPostFavorite');
    Route::get('list-user-follows', 'APIs\CustomerController@listUserFollows');
    Route::post('action-user-follows', 'APIs\CustomerController@actionUserFollows');
//    Route::apiResource('category-news', 'APIs\CategoryNewsController');
//    Route::get('category-news/{id}/news', 'APIs\CategoryNewsController@listNewsOfCategory');
//    Route::post('upload/image', 'APIs\UploadController@image');
    Route::post('change-password', 'APIs\AuthController@changePassword');
    Route::get('info-customer', 'APIs\AuthController@infoCustomer');
    Route::post('edit-profile', 'APIs\AuthController@editProfile');
});
