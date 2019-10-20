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

// Route::get('/', function () {
    // return view('welcome');
Route::get('/', 'Frontend\HomeController@index');
// });
/*
 * CMS Login route
 */
Route::group(['middleware' => 'middleware', 'middleware' => ['auth']], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('', 'Backend\DashboardController@index');
    });
});

Auth::routes();
