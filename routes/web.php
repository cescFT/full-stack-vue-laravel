<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/cityWeatherResult', function () {
    return view('cityweather');
});

Route::get('/fetchCityByName/{name}', 'App\Http\Controllers\CityController@findCityByName');
Route::get('/fetchWeather/{cityId}', 'App\Http\Controllers\WeatherController@getWeatherFromCity');
