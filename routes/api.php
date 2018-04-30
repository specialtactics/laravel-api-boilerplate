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

/**
 * Welcome route - link to any public API documentation here
 */
Route::get('/', function () {
    echo 'Welcome to our API';
});


/**
 * @var $api \Dingo\Api\Routing\Router
 */
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function($api) {
    /**
     * Authentication
     */
    $api->group(['prefix' => 'auth'], function($api) {
        $api->group(['prefix' => 'jwt'], function($api) {
            $api->get('/login', 'App\Http\Controllers\Auth\AuthController@login');
            $api->get('/token', 'App\Http\Controllers\Auth\AuthController@token');
            $api->get('/refresh', 'App\Http\Controllers\Auth\AuthController@refresh');
            $api->delete('/token', 'App\Http\Controllers\Auth\AuthController@logout');
        });

        $api->get('/me', 'App\Http\Controllers\Auth\AuthController@getUser');
    });

    /**
     * Users
     */
    $api->group(['prefix' => 'users'], function($api) {
        $api->get('/', 'App\Http\Controllers\UsersController@getAll');
        $api->get('/{uuid}', 'App\Http\Controllers\UsersController@get');
        $api->post('/', 'App\Http\Controllers\UsersController@post');
        $api->put('/{uuid}', 'App\Http\Controllers\UsersController@put');
        $api->patch('/{uuid}', 'App\Http\Controllers\UsersController@patch');
        $api->delete('/{uuid}', 'App\Http\Controllers\UsersController@delete');
    });

});
