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
Route::get('/', 'Frontend\HomeController@index')->name('home');
Route::get('/detail-match/{id}', 'Frontend\ResultDetailController@detailMatch')->name('detailMatch');
Route::get('/live-match/{id}', 'Frontend\ResultDetailController@liveMatch')->name('liveMatch');
Route::group(['prefix' => 'ajax'], function () {
	Route::post('/detail-match', 'Frontend\AjaxController@ajaxDetailMatch')->name('ajaxDetailMatch');
});
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
