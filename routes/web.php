<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes();

/**
 * account
 */
Route::prefix('account')->group(function () {

    //dashboard account
    Route::get('/dashboard', 'account\DashboardController@index')->name('account.dashboard.index');

    //categories debit
    Route::get('/categories_debit/search', 'account\CategoriesDebitController@search')->name('account.categories_debit.search');
    Route::Resource('/categories_debit', 'account\CategoriesDebitController',['as' => 'account']);
    //debit
    Route::get('/debit/search', 'account\DebitController@search')->name('account.debit.search');
    Route::Resource('/debit', 'account\DebitController',['as' => 'account']);
    //categories credit
    Route::get('/categories_credit/search', 'account\CategoriesCreditController@search')->name('account.categories_credit.search');
    Route::Resource('/categories_credit', 'account\CategoriesCreditController',['as' => 'account']);
    //credit
    Route::get('/credit/search', 'account\CreditController@search')->name('account.credit.search');
    Route::Resource('/credit', 'account\CreditController',['as' => 'account']);
    //laporan debit
    Route::get('/laporan_debit', 'account\LaporanDebitController@index')->name('account.laporan_debit.index');
    Route::get('/laporan_debit/check', 'account\LaporanDebitController@check')->name('account.laporan_debit.check');
    //laporan credit
    Route::get('/laporan_credit', 'account\LaporanCreditController@index')->name('account.laporan_credit.index');
    Route::get('/laporan_credit/check', 'account\LaporanCreditController@check')->name('account.laporan_credit.check');

});
