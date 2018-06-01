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

Route::get('/', function () {
    // return view('welcome');
    return Redirect::to('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/add-member', 'MemberController@create');
Route::post('/add-member', 'MemberController@store');
Route::get('/member/{id}/edit', 'MemberController@edit');
Route::put('/update-member', 'MemberController@update');
Route::delete('/delete-member', 'MemberController@delete');
Route::get('/members', 'MemberController@members');
Route::get('/member/{id}', 'MemberController@showMember');
Route::post('/search-member', 'MemberController@searchMember');
Route::get('/change-admin', 'MemberController@showChangeAdmin');
Route::post('/change-admin', 'MemberController@changeAdmin');