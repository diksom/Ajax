<?php

use App\Http\Controllers\TodoController;
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
Route::get('todo', 'TodoController@index');
Route::post('todo', 'TodoController@store');
Route::post('todo/change-done-status/{id}', 'TodoController@changeDoneStatus');
Route::post('todo/delete/{id}', 'TodoController@delete');
