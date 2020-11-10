<?php

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

Route::group(['prefix' => 'v1', 'middleware' => ['api']], function () {

    // Events
    Route::group(['prefix' => 'events'], function () {
        Route::get('', 'EventsController@getAll');
        Route::get('{event}', 'EventsController@getEvent');
        Route::post('', 'EventsController@store');
    });

    // Comments
    Route::group(['prefix' => 'comments'], function () {
        Route::post('/update-status/{comment}', 'CommentController@updateStatus'); // --done-- 3. Update comment - is active status
        Route::post('', 'CommentController@store'); // --done-- 1. Create comment
        Route::delete('{comment}', 'CommentController@destroy'); // --done-- 2. Delete comment
        Route::get('/by-event/{event}', 'CommentController@commentsByEvent'); // --done-- 4. Get comments by event id
        Route::get('', 'CommentController@getAll'); // --done-- 5. Get all comments
        Route::get('{comment}', 'CommentController@getComment'); // get single comment        
    });

});
