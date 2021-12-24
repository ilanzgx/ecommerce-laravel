<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;


Route::post('/login/signin', 'LoginController@signin');
Route::post('/login/signup', 'LoginController@signup');
Route::post('/login/logout', 'LoginController@logout');
Route::post('/login/header/session', 'LoginController@header_session');

Route::post('/cart/add', 'CartController@add_cart');
Route::post('/cart/remove', 'CartController@remove_cart');
Route::post('/cart/update', 'CartController@update_cart');
Route::post('/cart/clear', 'CartController@clear_cart');
Route::post('/cart/total', 'CartController@total_cart');

Route::post('/admin/signin', 'AdminController@signin');
Route::post('/admin/create/product', 'AdminController@create_product');
Route::post('/admin/remove/product', 'AdminController@remove_product');
Route::post('/admin/edit/product', 'AdminController@edit_product');
Route::post('/admin/create/category', 'AdminController@create_category');
Route::post('/admin/get/product', 'AdminController@get_product_data');

Route::post('/user/changedata', 'CustomerController@changedata');
Route::post('/user/change/address', 'CustomerController@changeaddress');

Route::post('/password/forget', 'LoginController@forget_password');
Route::post('/password/reset', 'LoginController@reset_password');

Route::post('/assessment/create', 'AssessmentController@createAssessment');

Route::post('/order/payment', 'OrderController@order_payment');