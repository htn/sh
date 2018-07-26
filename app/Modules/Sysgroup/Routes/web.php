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

Route::group(['prefix' => 'sysgroup'], function () {
    Route::get('/', 'SysGroupController@index');
    Route::post('/list', 'SysGroupController@grid');
    Route::post('/edit', 'SysGroupController@edit');
    Route::post('/save', 'SysGroupController@save');
    Route::post('/delete', 'SysGroupController@delete');
    Route::get('/export', 'SysGroupController@exportFile');
});