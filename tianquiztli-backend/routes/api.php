<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('v1/')->group(function () 
{
    Route::prefix('users/')->group(function () {
        Route::get('index/{artisanId}/{text?}','UserController@index')->middleware('jwt');
        Route::post('store','UserController@store');
        Route::put('edit/{userId}','UserController@edit')->middleware('jwt');
        Route::get('show/{userId}','UserController@show')->middleware('jwt');
        Route::post('login','UserController@login');
        Route::post('logout','UserController@logout')->middleware('jwt');
    });
    Route::prefix('artisans/')->group(function () {
        Route::get('index/{text?}','ArtisanController@index')->middleware('jwt');
        Route::post('store','ArtisanController@store');
        Route::put('edit/{artisanId}','ArtisanController@edit')->middleware('jwt');
        Route::get('show/{artisanId}','ArtisanController@show')->middleware('jwt');
    });

    Route::prefix('sales/')->group(function () {
        Route::get('index/{userId}/{artisanId}/{text?}','SaleController@index')->middleware('jwt');
        Route::post('store/{userId}/{artisanId}','SaleController@store');
        Route::put('edit/{saleId}','SaleController@edit')->middleware('jwt');
        Route::get('show/{saleId}','SaleController@show')->middleware('jwt');
    });

    Route::prefix('sale_details/')->group(function () {
        Route::get('index/{saleId}/{productId}/{text?}','SaleDetailController@index')->middleware('jwt');
        Route::post('store/{saleId}/{productId}','SaleDetailController@store');
        Route::put('edit/{sale_detailId}','SaleDetailController@edit')->middleware('jwt');
        Route::get('show/{sale_detailId}','SaleDetailController@show')->middleware('jwt');
    });

    Route::prefix('categories/')->group(function () {
        Route::get('index/{text?}','CategorieController@index');
        Route::post('store','CategorieController@store')->middleware('jwt');
        Route::put('edit/{categorieId}','CategorieController@edit')->middleware('jwt');
        Route::get('show/{categorieId}','CategorieController@show')->middleware('jwt');
    });
    Route::prefix('products/')->group(function () {
        Route::get('index/{artisanId}/{categorieId}/{text?}','ProductController@index');
        Route::post('store/{artisanId}/{categorieId}','ProductController@store')->middleware('jwt');
        Route::put('edit/{productId}','ProductController@edit')->middleware('jwt');
        Route::delete('delete/{productId}','ProductController@delete')->middleware('jwt');
        Route::get('show/{productId}','ProductController@show');
    });
    Route::prefix('images/')->group(function () {
        Route::get('index/{productId}/{text?}','ImageController@index');
        Route::post('store/{productId}','ImageController@store')->middleware('jwt');
        Route::put('edit/{imageId}','ImageController@edit')->middleware('jwt');
        Route::delete('delete/{imageId}','ImageController@delete')->middleware('jwt');
        Route::get('show/{imageId}','ImageController@show');
    });
});
