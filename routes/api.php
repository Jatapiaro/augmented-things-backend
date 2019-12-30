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

Route::group([
    'as' => 'api.v1.',
    'prefix' => 'v1',
    'namespace' => 'Api\V1',
    ], function () {

    /**
     * Registration
     */
    Route::post('/register', 'AuthController@register');

    Route::group(['middleware' => ['auth:api']], function() {

        Route::get('/me', 'MeController@me');

        /**
         * Devices Routes
         */
        Route::apiResource('/devices', 'DeviceController');

        /**
         * Places Routes
         */
        Route::apiResource('/places', 'PlaceController');
        Route::get('/admin-places', 'PlaceController@adminIndex')->name('places.index.admin');

        /**
         * Types Routes
         */
        Route::apiResource('/types', 'TypeController');

        /**
         * Users Routes
         */
        Route::apiResource('/users', 'UserController');

    });

});
