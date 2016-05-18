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

/*Admin routes*/
Route::get('/admin/add_moderator', 'AdminController@displayModeratorForm')->middleware(["ifNotLoggedInGoLogIn", "checkIfAdmin"]);
Route::post('/admin/add_moderator', 'AdminController@createModerator')->middleware(["ifNotLoggedInGoLogIn", "checkIfAdmin"]);

/*Ad routes*/
Route::get('ad/{id}', 'AdController@show');
Route::get('ad/{id}/edit', 'AdController@edit')->middleware('ifNotLoggedInGoLogIn');
Route::patch('ad/{id}/edit', 'AdController@update');

Route::get('myads','AdController@myAds')->middleware('ifNotLoggedInGoLogIn');

/*Comment routes*/
Route::post('comment/add', 'CommentController@add')->middleware('ifNotLoggedInGoLogIn');
Route::get('comment/{id}/report', 'CommentController@report');
Route::get('comment/{id}/delete', 'CommentController@delete');