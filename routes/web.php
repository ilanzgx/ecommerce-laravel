<?php

use Illuminate\Support\Facades\Route;

/* HomeController */
Route::get('/', 'HomeController@index')->name('index');
Route::fallback('HomeController@show404')->name('404');

/* ProdutoController */
Route::get('/produto/{produtoid?}', 'ProdutoController@index')->name('produto.id');

/* LoginController */
Route::get('/login', 'HomeController@login')->name('login');
Route::get('/mudarsenha', 'HomeController@changePassword')->name('login.changepassword');
Route::get('/verificar/{token}', 'HomeController@verification')->name('login.verification');

/* CartController */
Route::get('/carrinho', 'CartController@index')->name('cart');
Route::get('/precarrinho/{produtoid?}', 'CartController@precart')->name('precart');

/* Back office */
Route::middleware(['admin'])->group(function() {
    Route::get('/admin', 'AdminController@index')->name('admin.index');
    Route::get('/admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
});
