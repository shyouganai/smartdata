<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login');

Route::apiResource('books', 'Api\\BookController')->except(['store', 'update', 'destroy']);
Route::apiResource('authors', 'Api\\AuthorController')->except(['store', 'update', 'destroy']);

Route::middleware('auth:api')->group(function () {
    Route::post('logout', 'UserController@logout');
    Route::get('me', 'UserController@about');

    Route::apiResource('books', 'Api\\BookController');
    Route::apiResource('authors', 'Api\\AuthorController');
});
