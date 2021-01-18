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
    Route::apiResource('authors', 'AuthorController')->except(['store', 'update', 'destroy']);
    Route::get('authors/{author_id}/books', 'AuthorController@books');
    Route::apiResource('books', 'BookController')->except(['store', 'update', 'destroy']);
});

    Route::middleware('auth:api')->group(function () {
    Route::post('logout', 'UserController@logout');
    Route::get('me', 'UserController@about');
    Route::get('favorite-books', 'UserController@favoriteBooks');

    Route::group(['namespace' => 'Api'], function () {
        Route::apiResource('books', 'BookController')->only(['store', 'update', 'destroy']);
        Route::group(['name' => 'books', 'prefix' => 'books'], function() {
            Route::group(['prefix' => '{book_id}'], function() {
                Route::post('upload-image', 'BookController@uploadImage');
                Route::post('add-to-favorites', 'BookController@addToFavorites');
                Route::post('remove-from-favorites', 'BookController@removeFromFavorites');
            });
        });
        Route::apiResource('authors', 'AuthorController')->only(['store', 'update', 'destroy']);
        Route::post('authors/{author_id}/upload-image', 'AuthorController@uploadImage');
    });
});
