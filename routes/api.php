<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login/signin', 'LoginController@signin');
Route::post('/login/signup', 'LoginController@signup');

Route::post('/cart/add', 'CartController@add_cart');
Route::post('/cart/remove', 'CartController@remove_cart');
Route::post('/cart/clear', 'CartController@clear_cart');
Route::post('/cart/update', 'CartController@update_cart');
Route::post('/cart/total', 'CartController@total_cart');

Route::post('/admin/signin', 'AdminController@signin');