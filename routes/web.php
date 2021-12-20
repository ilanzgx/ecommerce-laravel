<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;


/* HomeController */
Route::get('/', 'HomeController@index')->name('index');
Route::fallback('HomeController@show404')->name('404');
Route::get('/lancamentos', 'HomeController@releases')->name('home.releases');
Route::get('/destaques', 'HomeController@highlights')->name('home.highlights');
Route::get('/mais-vendidos', 'HomeController@topSellers')->name('home.topsellers');
Route::get('/ofertas', 'HomeController@offers')->name('home.offers');

/* ProdutoController */
Route::get('/produto/{produtoid?}', 'ProdutoController@index')->name('produto.id');

/* LoginController */
Route::get('/login', 'HomeController@login')->name('login')->middleware('notlogged');
Route::get('/mudarsenha', 'HomeController@changePassword')->name('login.changepassword')->middleware('logged');
Route::get('/verificar/{token}', 'LoginController@verification')->name('login.verification')->middleware('logged');

/* CartController */
Route::get('/carrinho', 'CartController@index')->name('cart');
Route::get('/precarrinho/{productid?}', 'CartController@precart')->name('precart');

/* OrderController */
Route::get('/pagamento/sucesso', 'OrderController@payment_success');
Route::get('/pagamento/aguardando', "OrderController@payment_pending");
Route::get('/pagamento/falha', 'OrderController@payment_fail');

Route::get('/pedido/pagamento', 'OrderController@payment')->name('order.payment');

/* WebHooksController */
Route::post('webhooks', 'WebhooksController');

/* CustomerController */
Route::middleware(['logged'])->group(function(){
    Route::get('/minha-conta', 'CustomerController@myaccount')->name('customer.myaccount');
    Route::get('/minha-conta/meus-dados', 'CustomerController@mydata')->name('customer.mydata');
    Route::get('/minha-conta/pedidos', 'CustomerController@orders')->name('customer.orders');
});

/* Back office */
Route::middleware(['admin'])->group(function() {
    Route::get('/admin', 'AdminController@index')->name('admin.index');
    Route::get('/admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
});