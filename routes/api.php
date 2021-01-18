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

Route::group(['namespace' => 'Api'], function () {
    Route::group(['name' => 'authors', 'prefix' => 'authors'], function() {
        Route::apiResource('', 'AuthorController')->except(['store', 'update', 'destroy']);
        Route::get('{author_id}/books', 'AuthorController@books');
    });
    Route::group(['name' => 'books', 'prefix' => 'books'], function() {
        Route::apiResource('', 'BookController')->except(['store', 'update', 'destroy']);
    });
});

    Route::middleware('auth:api')->group(function () {
    Route::post('logout', 'UserController@logout');
    Route::get('me', 'UserController@about');
    Route::get('favorite-books', 'UserController@favoriteBooks');

    Route::group(['namespace' => 'Api'], function () {
        Route::group(['name' => 'books', 'prefix' => 'books'], function() {
            Route::apiResource('', 'BookController')->only(['index', 'show']);
            Route::group(['prefix' => '{book_id}'], function() {
                Route::post('upload-image', 'BookController@uploadImage');
                Route::post('add-to-favorites', 'BookController@addToFavorites');
                Route::post('remove-from-favorites', 'BookController@removeFromFavorites');
            });
        });
        Route::group(['name' => 'authors', 'prefix' => 'authors'], function() {
            Route::apiResource('', 'AuthorController')->only(['index', 'show']);
            Route::post('{author_id}/upload-image', 'AuthorController@uploadImage');
        });
    });
});
