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

//Route::auth();

// Authentication Routes...
Route::get('login', 'Auth\AuthController@showLoginForm');
Route::get('logout', 'Auth\AuthController@logout');

/*
 * Homepage and user
 */

Route::get('/redirect/facebook', 'SocialAuthController@redirect');
Route::get('/callback/facebook', 'SocialAuthController@callback');

Route::get('/redirect/google', 'SocialAuthController@googleRedirect');
Route::get('/callback/google', 'SocialAuthController@googleCallback');



Route::get('/', 'HomeController@index');

Route::get('about', function () {
    return view('about');
});


/*
 * User controller
 */

Route::get('user/profile', [
    'middleware' => 'auth',
    'uses' => 'UserController@profile'
]);

Route::get('user/history', [
    'middleware' => 'auth',
    'uses' => 'UserController@history'
]);

Route::post('user', [
    'middleware' => 'auth',
    'uses' => 'UserController@store'
]);

/*
 * Vote controller
 */

Route::get('vote/summary/{id}', [
    'uses' => 'VoteController@summary'
]);

Route::get('vote/history/{fingerprint}', [
    'uses' => 'VoteController@history'
]);

Route::get('vote/next/{id}/{date}', [
    'uses' => 'VoteController@next'
]);

Route::get('vote/create', [
    'middleware' => 'auth',
    'uses' => 'VoteController@create',
]);

Route::post('vote', 'VoteController@store');
Route::post('vote/giveVote', 'VoteController@vote');
