<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;


class CartController extends Controller
{
    public function index(Request $request){
        if(!$request->session()->exists('cart') || $request->session('cart') == null){
            return Inertia::render('Cart', ['empty' => true]);
        } else {
            $ids = [];
            foreach(session('cart') as $product_id => $amount){
                array_push($ids, $product_id);
            }
            
            $ids = implode(',', $ids);
            $results = Product::search_products_by_ids($ids);
            //dd(session('cart'));

            $data_tmp = [];
            foreach(session('cart') as $product_id => $cart_amount){
                foreach($results as $product){
                    if($product->id == $product_id){
                        $id = $product->id;
                        $image = $product->image;
                        $name = $product->name;
                        $amount = $cart_amount;
                        $original_price = $product->price;
                        $price = $product->price * $amount;
                        $stock = $product->stock;

                        array_push($data_tmp, [
                            'id'   => $id,
                            'name'  => $name,
                            'image' => $image,
                            'amount' => $amount,
                            'price' => $price,                            
                            'original_price' => $original_price,
                            'stock' => $stock
                        ]);
                        break;
                    }
                }
            }

            $total_value = 0;
            foreach($data_tmp as $item){
                $total_value += $item['price'];
            }

            //dd($data_tmp);

            return Inertia::render('Cart', [
                'empty' => false, 
                'products'  => $data_tmp,
                'total_value' => $total_value 
            ]);
        }
    }

    public function precart($productid=0){
        $data = Product::find($productid);
        if(!$data){
            return redirect()->route('index');
        }
        return Inertia::render('PreCart', ['data' => $data]);
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
        $values = [
            'productid' => $request->product_id,
            'amount' => $request->amount,
        ];

        $productid = $values['productid'];

        if($values['amount'] >= 1){
            Session::put("cart.$productid", $values['amount']);
        }

        return json_encode(['success' => true, 'debug' => session('cart')]);
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
