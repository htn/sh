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

Route::group(['prefix' => 'sysuser'], function () {
    Route::get('/', 'SysUserController@index');
    Route::post('/list', 'SysUserController@grid');
    Route::post('/edit', 'SysUserController@edit');
    Route::post('/save', 'SysUserController@save');
});
