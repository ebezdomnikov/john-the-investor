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

Route::get('/overview/companies', 'OverviewCompanyController@index')->name('overviewCompany');

Route::get('/overview/markets', 'OverviewMarketController@index')->name('overviewMarket');

Route::get('/overview/hightrades', 'OverviewHighTradeController@index')->name('overviewHighTrade');

Route::resource('/manage/companies', 'CompanyController');
Route::resource('/manage/markets', 'MarketController');
Route::resource('/manage/prices', 'MarketPriceController');

Route::redirect('/', '/overview/companies', 301);
