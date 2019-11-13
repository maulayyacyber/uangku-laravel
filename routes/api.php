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
Route::post('/v1/login', 'api\v1\Auth\LoginController@index')->name('api.login');
Route::post('/v1/register', 'api\v1\Auth\RegisterController@index')->name('api.login');

/**
 * Account
 */
Route::prefix('/v1/account')->group(function () {

    Route::group(['middleware' => ['auth:api']], function () {
        //saldo
        Route::get('/saldo', 'api\v1\account\SaldoController@index')->name('account.api.saldo');
        //categories debit
        Route::get('/categories_debit', 'api\v1\account\CategoriesDebitController@index')->name('account.api.categories_debit.index');
        Route::post('/categories_debit/store', 'api\v1\account\CategoriesDebitController@store')->name('account.api.categories_debit.store');
        //categories credit
        Route::get('/categories_credit', 'api\v1\account\CategoriesCreditController@index')->name('account.api.categories_credit.index');
        //debit
        Route::get('/debit', 'api\v1\account\DebitController@index')->name('account.api.debit.index');
        //credit
        Route::get('/credit', 'api\v1\account\CreditController@index')->name('account.api.credit.index');
    });

});
