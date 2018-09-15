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


// Route::prefix('admin')->group(function () {
//     Route::get('users', function () {
//         return 'hello';
//     });
// });

Route::get('/','Wechat\IndexController@index');
Route::post('/addline','Wechat\IndexController@addline');
Route::get('/delete','Wechat\IndexController@delete');
Route::post('/upload','Wechat\IndexController@upload');
Route::get('/download','Wechat\IndexController@download');