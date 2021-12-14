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
        
        // no address
        if($values['address'] == null){
            return json_encode(['success' => false, 'action' => 1]);
        }
        
        $preference = new Preference();

        # Building an item

        $data = [];
        foreach(session('cart') as $id => $amount){
            $product = Product::where('id', $id)->first();

            $item = new Item();
            $item->id = $id;
            $item->title = $product->name;
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
            "success" => env('APP_URL') . "/pagamento/sucesso",
            "failure" => env('APP_URL') . "/pagamento/falha",
            "pending" => env('APP_URL') . "/pagamento/aguardando"
        );
        
        $preference->auto_return = "approved";
        
        $preference->save();

        //dd(Customer::create_customer([]));
        //dd(Customer::update_customer('1038710704-GtecwfklJrZtXE'));
       
        return json_encode([
            'success' => true, 
            'action' => 2, 
            //'link' => $preference->sandbox_init_point, 
            'link' => $preference->init_point,
            'preference_id' => $preference->id
        ]);
    }

    public function payment_success(){
        if(!isset($_GET['payment_id']) || !isset($_GET['preference_id'])){
            return redirect()->back();
        }

        if($_GET['status'] == null){
            return redirect()->route('cart');
        }

        $data = Http::withHeaders([
            'Authorization' => 'Bearer '. config('services.mercadopago.token'),
            'Content-Type'  => 'application/json'
        ])->get('https://api.mercadopago.com/v1/payments/'.$_GET['payment_id'])->json();

        return Inertia::render('Payment/Success.vue', [
            'data' => $data
        ]);
    }

    public function payment_pending(){
        if(!isset($_GET['payment_id']) || !isset($_GET['preference_id'])){
            return redirect()->back();
        }

        if($_GET['status'] == null){
            return redirect()->route('cart');
        }

        $data = Http::withHeaders([
            'Authorization' => 'Bearer '. config('services.mercadopago.token'),
            'Content-Type'  => 'application/json'
        ])->get('https://api.mercadopago.com/v1/payments/'.$_GET['payment_id'])->json();

        return Inertia::render('Payment/Pending.vue', [
            'data' => $data
        ]);
    }

    public function payment_fail(){
        if(!isset($_GET['payment_id']) || !isset($_GET['preference_id'])){
            return redirect()->back();
        }

        if($_GET['status'] == null){
            return redirect()->route('cart');
        }

        $data = Http::withHeaders([
            'Authorization' => 'Bearer '. config('services.mercadopago.token'),
            'Content-Type'  => 'application/json'
        ])->get('https://api.mercadopago.com/v1/payments/'.$_GET['payment_id'])->json();

        return Inertia::render('Payment/Fail.vue', [
            'data' => $data
        ]);
    }
}