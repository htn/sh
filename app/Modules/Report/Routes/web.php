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

Route::group(['prefix' => 'report'], function () {    
    Route::get('/', 'ReportController@index');
    Route::post('/list', 'ReportController@grid');
    Route::post('/edit', 'ReportController@edit');
    Route::post('/save', 'ReportController@save');
    Route::post('/delete', 'ReportController@delete');
    Route::get('/export', 'ReportController@exportFile');
});
