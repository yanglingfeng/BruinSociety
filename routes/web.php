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

Route::get('/', 'SocietyController@listUserSocieties');

//Route::get('/', 'ListController@show');

Route::get('/password', 'ListController@showUserInfo');


// /login for login /lout for logging out /register for registering
Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/got', [
  'middleware' => ['auth'],
  'uses' => function () {
   echo "You are allowed to view this page!";
}]);

Route::get('lout', 'LogOutController@logOut');

Route::get('join', 'SocietyController@join');

Route::get('quit', 'SocietyController@quit');

Route::get('listSocieties', 'SocietyController@listAllSocieties');