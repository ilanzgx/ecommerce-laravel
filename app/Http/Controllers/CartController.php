<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;


class CartController extends Controller
{
    public function index(){
        return Inertia::render('Cart', ['data' => session()->all()]);
    }

    public function precart(){
        return Inertia::render('PreCart');
    }

    public function add_cart(Request $request){
        // receive product id
        $product_id = $request->id;

        // init cart array
        $cart = array();

        // verify if session exists and reuse its data
        if($request->session()->has('cart')){
            $cart = session('cart');
        }

        // check if product already added
        if(key_exists($product_id, $cart)){
            $cart[$product_id] += 1;
        } else {
            $cart[$product_id] = 1;
        }
        
        // update cart
        session(['cart' => $cart]);

        // count total products
        $total_products = 0;
        foreach($cart as $amount){
            $total_products += $amount;
        }
        echo $product_id;
    }

    public function remove_cart(Request $request){
        dd($request->id);
    }

    public function clear_cart(Request $request){
        dd($request->id);
    }

    public function update_cart(Request $request){
        dd($request->id);
    }

    public function total_cart(Request $request){
        $cart = [];

        if($request->session()->has('cart')){
            $cart = session('cart');
        }

        $total_products = 0;
        foreach($cart as $amount){
            $total_products += $amount;
        }
        echo $total_products;
    }
}
