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
//     // return view('welcome');
//     return Redirect::to('login');
// });

// Auth::routes();
Route::get('/', 'Auth\LoginController@showLoginForm');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'HomeController@sendOtp');
Route::post('logout', 'Auth\LoginController@logout');

Route::get('get-otp', 'HomeController@getOtp');
Route::post('check-otp', 'HomeController@checkOtp');

Route::get('/home', 'MemberHomeController@index')->name('home');
Route::get('/marriage', 'MemberHomeController@marriage');

// super admin group member
Route::get('/group-member', 'MemberHomeController@groupMember');
Route::post('/get-sub-groups-by-group-id', 'MemberHomeController@getSubGroupsByGroupId');
Route::post('/get-position-by-group-id-by-sub-group-id', 'MemberHomeController@getPositionByGroupIdBySubGroupId');
Route::post('/associate-group', 'MemberHomeController@associateGroup');

//member
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
Route::get('/blood-group', 'MemberController@showBloodGroup');
Route::post('/search-blood', 'MemberController@searchBlood');
Route::post('/search-marriage-member', 'MemberController@searchMarriageMember');

// business
Route::get('/add-business', 'BusinessController@show');
Route::get('/create-business', 'BusinessController@create');
Route::post('/get-sub-category-by-category-id', 'BusinessController@getSubCategoryByCategoryId');
Route::post('/create-business', 'BusinessController@store');
Route::get('/business/{id}/edit', 'BusinessController@edit');
Route::put('/update-business', 'BusinessController@update');
Route::delete('/delete-business', 'BusinessController@delete');
Route::get('/search-business', 'BusinessController@showAllBusiness');
Route::post('/search-business', 'BusinessController@searchBusiness');
Route::get('/business/{id}', 'BusinessController@showBusiness');