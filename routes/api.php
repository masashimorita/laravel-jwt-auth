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

Route::get('/quotes', 'QuoteController@getQuotes');
Route::post('/user', 'UserController@register');
Route::post('/user/login', 'UserController@login');

Route::group(['middleware' => 'jwt.auth'], function() {
    Route::post('/quote', 'QuoteController@postQuote');
    Route::put('/quote/{id}', 'QuoteController@putQuote');
    Route::delete('/quote/{id}', 'QuoteController@deleteQuote');

    Route::get('user', 'UserController@getAuthUser');
});