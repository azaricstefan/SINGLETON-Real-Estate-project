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

Route::get('ad', function(){
   return view('ad.create');
});