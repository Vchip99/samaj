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
Route::get('/panchayat', 'MemberHomeController@panchayat');
Route::get('/navyuvak-mandal', 'MemberHomeController@navyuvakMandal');
Route::get('/mahila-mandal', 'MemberHomeController@mahilaMandal');
Route::get('/varishth-nagrik', 'MemberHomeController@varishthNagrik');
Route::get('/jilha-sangathan', 'MemberHomeController@jilhaSangathan');
Route::get('/seva-manch', 'MemberHomeController@sevaManch');
Route::get('/aadhar-samity', 'MemberHomeController@aadharSamity');
Route::post('/get-group-member-by-id', 'MemberHomeController@getGroupMemberById');

Route::get('/show-notification', 'NotificationController@show');
Route::get('/create-notification', 'NotificationController@create');
Route::post('/create-notification', 'NotificationController@store');
Route::get('/notification/{id}/edit', 'NotificationController@edit');
Route::put('/update-notification', 'NotificationController@update');
Route::delete('/delete-notification', 'NotificationController@delete');
Route::get('/notifications', 'NotificationController@notifications');

Route::get('/show-contact', 'ContactController@show');
Route::get('/create-contact', 'ContactController@create');
Route::post('/create-contact', 'ContactController@store');
Route::get('/contact/{id}/edit', 'ContactController@edit');
Route::put('/update-contact', 'ContactController@update');
Route::delete('/delete-contact', 'ContactController@delete');
Route::get('/contacts', 'ContactController@contacts');

Route::get('/show-job', 'JobController@show');
Route::get('/create-job', 'JobController@create');
Route::post('/create-job', 'JobController@store');
Route::get('/job/{id}/edit', 'JobController@edit');
Route::put('/update-job', 'JobController@update');
Route::delete('/delete-job', 'JobController@delete');
Route::get('/jobs', 'JobController@jobs');

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
Route::post('/search-member-by-profession', 'MemberController@searchMemberByProfession');
Route::post('/search-marriage-member-by-gender', 'MemberController@searchMarriageMemberByGender');



// business
Route::get('/add-business', 'BusinessController@show');
Route::get('/create-business', 'BusinessController@create');
Route::post('/get-business-by-category', 'BusinessController@getBusinessByCategory');
Route::post('/create-business', 'BusinessController@store');
Route::get('/business/{id}/edit', 'BusinessController@edit');
Route::put('/update-business', 'BusinessController@update');
Route::delete('/delete-business', 'BusinessController@delete');
Route::get('/search-business', 'BusinessController@showAllBusiness');
Route::post('/search-business', 'BusinessController@searchBusiness');
Route::get('/business/{id}', 'BusinessController@showBusiness');