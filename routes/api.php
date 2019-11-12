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
 * Api Auth
 */
Route::post('/v1/login', 'api\v1\Auth\LoginController@login')->name('api.login');

/**
 * Account
 */
Route::prefix('/v1/account')->group(function () {

    Route::group(['middleware' => ['auth:api']], function () {
        //profil
        Route::get('/saldo', 'api\v1\account\SaldoController@index')->name('account.api.saldo');
    });

});
