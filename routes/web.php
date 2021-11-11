<?php

use Illuminate\Support\Facades\Route;

/* HomeController */
Route::get('/', 'HomeController@index')->name('index');
Route::get('/login', 'HomeController@login')->name('login');
Route::fallback('HomeController@show404');

/* ProdutoController */
Route::get('/produto/{produtoid?}', 'ProdutoController@index')->name('produto.id');

/* LoginController */

/* CartController */
Route::get('/carrinho', 'CartController@index')->name('carrinho');
Route::get('/precarrinho/{produtoid?}', 'CartController@precart')->name('precart');