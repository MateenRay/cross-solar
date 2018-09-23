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

Route::middleware('api')->post('/panels', 'PanelController@store');

Route::middleware('api')->post('/one_hour_electricity', 'OneHourElectricityController@index');

Route::middleware('api')->post('/one_hour_electricities', 'OneHourElectricityController@store');

Route::middleware('api')->post('/one_day_electricities', 'OneDayElectricityController@index');

Route::middleware('api')->post('/one_month_electricities', 'OneDayElectricityController@monthData');
Route::middleware('api')->post('/one_year_electricities', 'OneDayElectricityController@yearData');
