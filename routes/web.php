<?php

use Illuminate\Support\Facades\Route;

/* HomeController */
Route::get('/', 'HomeController@index')->name('index');
Route::get('/carrinho', 'HomeController@carrinho')->name('carrinho');
Route::get('/login', 'HomeController@login')->name('login');
Route::fallback('HomeController@show404');

/* ProdutoController */
Route::get('/produto/{produtoid?}', 'ProdutoController@index')->name('produto.id');

/* LoginController */