<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');  //ホーム画面表示

Route::get('/mypage/{user_id}' , 'ProfileController@show')->name('mypage.show');  //マイページ表示
Route::get('/mypage/{user_id}/edit' , 'ProfileController@edit')->name('profile.edit');  //マイページ編集
Route::put('/mypage/{user_id}' , 'ProfileController@update')->name('profile.update');  //マイページ更新

Route::get('/room/{room_id}' , 'ChatController@show')->name('chatroom.show');  //チャットルーム表示
Route::post('/room/{room_id}' , 'ChatController@store')->name('chat.store');  //チャット投稿、保存


