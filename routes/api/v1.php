<?php

Route::prefix("books")->group(function () {
    Route::get('list', 'Api\V1\BookController@index');
    Route::get('{book}', 'Api\V1\BookController@show');
    Route::delete('{book}', 'Api\V1\BookController@destroy');
    Route::post('{book}/update', 'Api\V1\BookController@update');
});
