<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/users/{username}', 'GithubController@user');
Route::get('/users/{username}/repos', 'GithubController@methodNotAllowed');
Route::match(['post', 'put', 'delete', 'patch', 'delete'], '/users/{username}', 'GithubController@methodNotAllowed');
Route::match(['post', 'put', 'delete', 'patch', 'delete'], '/users/{username}/repos', 'GithubController@methodNotAllowed');

