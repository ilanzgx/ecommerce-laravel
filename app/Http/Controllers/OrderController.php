<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Http;
use MercadoPago\Payment;
use MercadoPago\SDK;

class OrderController extends Controller
{
    public function payment_method(){
        
        $ids = [];
        foreach(session('cart') as $product_id => $amount){
            if($amount >= 1){
                array_push($ids, $product_id);
            }
        }
        
        if(empty($ids)){
            return Inertia::render('Cart', ['empty' => true]);
        }

        $ids = implode(',', $ids);
        $results = Product::search_products_by_ids($ids);

        $data_tmp = [];
        $data_aa = [];
        foreach(session('cart') as $product_id => $cart_amount){
            array_push($data_aa, [
                'id' => $product_id,
                'amount' => $cart_amount
            ]);
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

        $user = Customer::where('email', session('email'))->first();
  
        return Inertia::render('PaymentMethod', [
            'cart' => session('cart'),
            'user' => $user,
            'address' => Address::where('customer_id', $user->id)->first(),
            'data'  => $data_aa,
            'total_value' => $total_value 
        ]);
    }

    public function pix_payment(Request $request){

        $values = [
            'total'   => $request->total_value,
            'user'    => $request->user,
            'address' => $request->address,
        ];

        SDK::setAccessToken(config('services.mercadopago.token'));

        $payment = new Payment();
        $payment->transaction_amount = $values['total'];
        $payment->description = "Título do produto";
        $payment->payment_method_id = "pix";
        $payment->payer = array(
            "email" => $values['user']['email'],
            "first_name" => $values['user']['full_name'],
            "last_name" => $values['user']['full_name'],
            "identification" => array(
                "type" => "CPF",
                "number" => $values['user']['cpf']
            ),
            "address" =>  array(
                "zip_code" => $values['address']['cep'],
                "street_name" => $values['address']['logradouro'],
                "street_number" => $values['address']['number'],
                "neighborhood" => $values['address']['district'],
                "city" => $values['address']['city'],
                "federal_unit" => $values['address']['uf']
            )
        );
        
        $payment->save();

        $user = Customer::where('email', session('email'))->first();
        $new_order = new Order();  // salvar o id da transação

        $new_order->customer_id = $user->id;
        $new_order->transaction_id = $payment->id;
        $new_order->total_order_price = $payment->transaction_amount;
        $new_order->status = $payment->status;
        $new_order->payment_method = $payment->payment_method_id;
        $new_order->payment_type = $payment->payment_type_id;

        $new_order->save();

        return json_encode(['success' => true]);
    }

    public function pix_transaction(){
        return Inertia::render('Payments/Pix.vue');
    }
}