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

Route::get('jobs', 'jobRetriever@index');
Route::get('jobs/{id}', 'jobRetriever@show');
Route::post('jobs', 'jobRetriever@addJob');
Route::put('jobs', 'jobRetriever@update');

Route::get('dashboard', 'jobRetriever@dashboardIndex');
Route::put('dashboard', 'jobRetriever@dashboardUpdate');

Route::post('application', 'jobRetriever@insertApplication');
Route::get('companies', 'jobRetriever@company');