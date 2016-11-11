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

/** Following routes are for authentication
 * /login for logging in
 * /lout for logging out
 * /register for register
*/
Auth::routes();

Route::get('lout', 'LogOutController@logOut');

// Route for the main page(welcome view)
Route::get('/', 'SocietyController@listUserSocieties');

// Route for the profile page
// TODO: change '/password' to 'profile'
Route::get('/password', 'ListController@showUserInfo');

// TODO: deprecate this route
Route::get('/home', 'HomeController@index');

// TODO: deprecate this route
Route::get('/got', [
  'middleware' => ['auth'],
  'uses' => function () {
   echo "You are allowed to view this page!";
}]);

/**
 * The following routes are related to join/ delete/ listing societies.
 */

Route::get('join', 'SocietyController@join');

Route::get('quit', 'SocietyController@quit');

Route::get('listSocieties', 'SocietyController@listAllSocieties');

// TODO: change to post later
Route::get('create', 'SocietyController@createSociety');

Route::get('delete', 'SocietyController@deleteSociety');

// Returns the view for the form of creating a societyk
Route::get('createSociety', function () {
    return view('createForm');
});

/**
 * The folllowing routes are related to showing discussions of a society.
 */

Route::get('showDiscussions', 'DiscussionController@show');

Route::get('showPost', 'PostController@show');
