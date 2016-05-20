<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function(){
    return view('index');
});

Route::get('login', [ 'middleware' => 'ifLoggedInGoHome', 'uses' => 'AuthController@openLogin']);
Route::get('register',[ 'middleware' => 'ifLoggedInGoHome', 'uses' =>  'AuthController@openRegister']);

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');

Route::get('logout', function(){
    Auth::logout();
    return redirect('/');
});

Route::get('/dashboard', 'DashboardController@selectDashboard')->middleware("ifNotLoggedInGoLogIn");
Route::get('/dashboard/admin','AdminDashboardController@index')->middleware(["ifNotLoggedInGoLogIn" , "dashboardSelector"]);
Route::get('/dashboard/moderator','ModeratorDashboardController@index')->middleware(["ifNotLoggedInGoLogIn" , "dashboardSelector"]);
Route::get('/dashboard/user','UserDashboardController@index')->middleware(["ifNotLoggedInGoLogIn" , "dashboardSelector"]);

Route::get('ad/create', function(){
   return view('ad.create');
})->middleware('ifNotLoggedInGoLogIn');

Route::post('ad/create', 'AdController@create');

/*User update profile*/
Route::get('user/updateProfile', 'UserDashboardController@updateProfile')->middleware('ifNotLoggedInGoLogIn');
Route::post('user/updateProfile', 'UserDashboardController@updateProfile')->middleware('ifNotLoggedInGoLogIn');

/*Admin routes*/
Route::get('/admin/add_moderator', 'AdminController@displayModeratorForm')->middleware(["ifNotLoggedInGoLogIn", "checkIfAdmin"]);
Route::post('/admin/add_moderator', 'AdminController@createModerator')->middleware(["ifNotLoggedInGoLogIn", "checkIfAdmin"]);
Route::get('/admin/registered_users', 'AdminController@getRegisteredUsers')->middleware(["ifNotLoggedInGoLogIn", "checkIfAdmin"]);
Route::get('/admin/delete_user/{user}', 'AdminController@deleteUser')->middleware(["ifNotLoggedInGoLogIn", "checkIfAdmin"]);

/*Ad routes*/
Route::get('ad/{id}', 'AdController@show');
Route::get('ad/{id}/edit', 'AdController@edit')->middleware('ifNotLoggedInGoLogIn');
Route::patch('ad/{id}/edit', 'AdController@update');
Route::get('ad/{ad}/approve', 'ModeratorController@approveAd')->middleware(['ifNotLoggedInGoLogIn', 'checkModeratorPrivileges']);
Route::get('ad/{ad}/deny', 'ModeratorController@denyAd')->middleware(['ifNotLoggedInGoLogIn', 'checkModeratorPrivileges']);
Route::get('ad/{ad}/delete', 'AdController@delete')->middleware('ifNotLoggedInGoLogIn');

Route::get('myads','AdController@myAds')->middleware('ifNotLoggedInGoLogIn');

/*Comment routes*/
Route::post('comment/add', 'CommentController@add')->middleware('ifNotLoggedInGoLogIn');
Route::get('comment/{id}/report', 'CommentController@report');
Route::get('comment/{id}/delete', 'CommentController@delete')->middleware(['ifNotLoggedInGoLogIn', 'checkModeratorPrivileges']);
Route::get('comment/{comment}/approve', 'CommentController@approveComment')->middleware(['ifNotLoggedInGoLogIn', 'checkModeratorPrivileges']);

/*Appointment routes*/
Route::get('appointments/{ad}/all7days','AppointmentController@all7days')->middleware('ifNotLoggedInGoLogIn')->middleware('adPending');
Route::post('appointment/{ad}', 'AppointmentController@reserve')->middleware('ifNotLoggedInGoLogIn');
Route::get('appointment/{appointment}/schedule', 'AppointmentController@schedule')->middleware(['ifNotLoggedInGoLogIn', 'checkModeratorPrivileges']);
Route::get('appointments/my_appointments', 'AppointmentController@myAppointments')->middleware('ifNotLoggedInGoLogIn');
Route::get('appointment/{appointment}/complete', 'AppointmentController@finish')->middleware(['ifNotLoggedInGoLogIn', 'checkModeratorPrivileges']);
Route::post('appointment/{appointment}/complete', 'AppointmentController@complete')->middleware(['ifNotLoggedInGoLogIn', 'checkModeratorPrivileges']);
Route::get('appointment/{appointment}/cancel', 'AppointmentController@cancel')->middleware('ifNotLoggedInGoLogIn');

/*Moderator route*/
Route::get('moderator/new_ads', 'ModeratorController@displayNewAds')->middleware(["ifNotLoggedInGoLogIn", "checkModeratorPrivileges"]);
Route::get('moderator/reported_comments' ,'ModeratorController@displayReported')->middleware(["ifNotLoggedInGoLogIn", "checkModeratorPrivileges"]);
Route::get('users', 'ModeratorController@displayUsers')->middleware(["ifNotLoggedInGoLogIn", "checkModeratorPrivileges"]);
Route::get('users/{user}', 'ModeratorController@displayUserInfo')->middleware(["ifNotLoggedInGoLogIn", "checkModeratorPrivileges"]);
Route::get('appointments/pending', 'ModeratorController@displayPendingAppointments');
 
