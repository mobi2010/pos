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
//     return view('welcome');
// });


//frontend
Route::group(['namespace' => 'Frontend', 'prefix' => '/'], function () {
    Route::get('/', 'HomeController@index');
    Route::get('webview/privacy_policy', 'WebViewController@privacyPolicy');
    Route::get('webview/help', 'WebViewController@help');
    Route::get('webview/about', 'WebViewController@about');
    Route::get('webview/user_agreement', 'WebViewController@userAgreement');
    Route::get('webview/commission_system', 'WebViewController@commissionSystem');

});