<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | This file is where you may define all of the routes that are handled
  | by your module. Just tell Laravel the URIs it should respond
  | to using a Closure or controller method. Build something great!
  |
 */

Route::group(['prefix' => 'productcatalog'], function () {
    Route::get('/', 'ProductCatalogController@index');
    Route::post('/list', 'ProductCatalogController@grid');
    Route::post('/load-catalog', 'ProductCatalogController@loadCatalog');
    Route::post('/edit', 'ProductCatalogController@edit');
    Route::post('/save', 'ProductCatalogController@save');
    Route::post('/delete', 'ProductCatalogController@delete');
    Route::get('/export', 'ProductCatalogController@exportFile');
});
