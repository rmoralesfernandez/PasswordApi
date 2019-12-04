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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('store', 'userController@store');
Route::post('login', 'userController@login');


Route::group(['middleware' => ['auth']], function ()
{
    Route::apiResource('categories', 'categoryController');
    Route::apiResource('users', 'userController');
    // Route::get('show', 'userController@show');
    // Route::delete('destroy', 'userController@destroy');
    // Route::post('update', 'userController@update');
});
