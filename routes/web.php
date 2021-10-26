<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('index');
Route::get('/carrinho', 'HomeController@carrinho')->name('carrinho');
Route::get('/login', 'HomeController@login')->name('login');
Route::get('/produto/{id?}', 'HomeController@index')->name('produto.id');
