<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Http;
use MercadoPago\SDK;
use MercadoPago\Item;
use MercadoPago\Payment;
use MercadoPago\Payer;
use MercadoPago\Preference;

class OrderController extends Controller
{
    
    public function order_payment(Request $request){
        SDK::setAccessToken(config('services.mercadopago.token'));

        $values = [
            'total'   => $request->total_value,
            'user'    => $request->user,
            'address' => $request->address,
        ];
        
        if(!session()->exists('logged')){
            $request->session()->flash('Entre ou crie uma conta antes de fazer uma compra.');
            return json_encode(['success' => false, 'action' => 3]);
        }
        // no address
        if($values['address'] == null){
            $request->session()->flash('Informe seu endereço antes de fazer uma compra.');
            return json_encode(['success' => false, 'action' => 1]);
        }

        if($values['user']['status'] !== 'verificado'){
            return json_encode(['success' => false, 'action' => 4, 'message' => 'Ative sua conta antes de fazer uma compra, verifique sua caixe da email/spam.']);
        }
        
        $preference = new Preference();

        $data = [];
        foreach(session('cart') as $id => $amount){
            $product = Product::where('id', $id)->first();

            $item = new Item();
            $item->id = $id;
            $item->title = $product->name;
            if($amount > $product->stock){
                return json_encode(['success' => false, 'message' => 'Estoque indisponivel']);
            }
            $item->quantity = $amount;
            $item->unit_price = $product->price;
            $item->description = $product->description;
            $item->picture_url = env('APP_URL').$product->image;
            array_push($data, $item);
        }


        $preference->items = $data;

        $preference->payment_methods = array(
            "excluded_payment_types" => array(
                //array("id" => "credit_card")
            ),
            "installments" => 12
        );

        $preference->external_reference = "Ecommerce";

        $preference->payer = Customer::search_customer($values['user']['customer_id']);
        
        $preference->back_urls = array(
            "success" => route('order.payment'),
            "failure" => route('order.payment'),
            "pending" => route('order.payment')
        );
        
        $preference->auto_return = "approved";
        
        $preference->save();
       
        return json_encode([
            'success' => true, 
            'action' => 2, 
            //'link' => $preference->sandbox_init_point, 
            'link' => $preference->init_point,
            'preference_id' => $preference->id
        ]);
    }

    public function payment(Request $request)   {
        if(!isset($_GET['payment_id'])){
            return redirect()->back();
        }

        if($_GET['status'] == null){
            return redirect()->route('cart');
        }

        $data = Http::withHeaders([
            'Authorization' => 'Bearer '. config('services.mercadopago.token'),
            'Content-Type'  => 'application/json'
        ])->get('https://api.mercadopago.com/v1/payments/'.$_GET['payment_id'])->json();

        $request->session()->forget('cart');

        switch($data['status']){
            case 'approved':{
                return Inertia::render('Payment/Success.vue', [
                    'data' => $data,
                    'items' => $data['additional_info']['items']
                ]);
                break;
            }
            case 'pending':{
                return Inertia::render('Payment/Pending.vue', [
                    'data' => $data,
                    'items' => $data['additional_info']['items']
                ]);
                break;
            }
            case 'cancelled':
            case 'fail':{
                return Inertia::render('Payment/Fail.vue', [
                    'data' => $data,
                    'items' => $data['additional_info']['items']
                ]);
                break;
            }
            default: {
                return $data;
            }
        }

        return http_response_code(500);
    }
}