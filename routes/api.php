<?php

use Illuminate\Http\Request;
use App\Product;
use Laract\Unit;
use Laract\UnitController;

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

/**
**Basic Routes for a RESTful service:
**Route::get($uri, $callback);
**Route::post($uri, $callback);
**Route::put($uri, $callback);
**Route::delete($uri, $callback);
**
*/




Route::get('products', 'ProductsController@index');

Route::get('products/{product}', 'ProductsController@show');

Route::post('products','ProductsController@store');

Route::put('products/{product}','ProductsController@update');

Route::delete('products/{product}', 'ProductsController@delete');

Route::get('players', 'PlayersController@index');

Route::get('players/{player}', 'PlayersController@show');

Route::post('players','PlayersController@store');

Route::put('players/{player}','PlayersController@update');

Route::delete('units/{unit}', 'UnitController@delete');

Route::get('units', 'UnitController@index');

Route::get('heroes', 'UnitController@heroes');

Route::get('monsters', 'UnitController@monsters');

Route::get('units/{unit}', 'UnitController@show');

Route::post('units','UnitController@store');

Route::put('units/{unit}','UnitController@update');

Route::delete('units/{unit}', 'UnitController@delete');

