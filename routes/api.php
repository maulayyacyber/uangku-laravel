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
        Route::post('/categories_credit/store', 'api\v1\account\CategoriesCreditController@store')->name('account.api.categories_credit.store');
        //debit
        Route::get('/debit', 'api\v1\account\DebitController@index')->name('account.api.debit.index');
        Route::post('/debit/store', 'api\v1\account\DebitController@store')->name('account.api.debit.store');
        //credit
        Route::get('/credit', 'api\v1\account\CreditController@index')->name('account.api.credit.index');
        Route::post('/credit/store', 'api\v1\account\CreditController@store')->name('account.api.credit.store');
        //laporan debit
        Route::get('/laporan_debit', 'api\v1\account\LaporanDebitController@index')->name('account.api.laporan_debit.index');
        //laporan credit
        Route::get('/laporan_credit', 'api\v1\account\LaporanCreditController@index')->name('account.api.laporan_credit.index');
    });

});
