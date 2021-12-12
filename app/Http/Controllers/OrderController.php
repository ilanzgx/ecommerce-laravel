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

//use PagSeguro\Configuration\Configure;
//use PagSeguro\Services\Session;

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
            array_push($data, $item);
        }

        $preference->items = $data;

        

        $payerdata = [
            "email" => $values['user']['email'],
            "first_name" => $values['user']['full_name'],
            "last_name" => $values['user']['full_name'],
            "identification" => [
                "type" => "CPF",
                "number" => $values['user']['cpf']
            ],
            "address"=>  [
                "zip_code" => $values['address']['cep'],
                "street_name" => $values['address']['logradouro'],
                "street_number" => $values['address']['number'],
                "neighborhood" => $values['address']['district'],
                "city" => $values['address']['city'],
                "federal_unit" => $values['address']['uf']
            ]
        ];
        $payer = new Payer($payerdata);
        $preference->payer = $payer;

        $preference->payment_methods = array(
            "excluded_payment_types" => array(
                //array("id" => "credit_card")
            ),
            "installments" => 12
        );

        $preference->external_reference = "A Custom External Reference";

        $preference->back_urls = array(
            "success" => env('APP_URL') . "/pagamento/sucesso",
            "failure" => env('APP_URL') . "/pagamento/falha",
            "pending" => env('APP_URL') . "/pagamento/aguardando"
        );

        $preference->auto_return = "approved";

        $preference->save();
        //dd($preference);

        /*$new_order = new Order();  // salvar o id da transação

        $new_order->customer_id = $values['user']['id'];
        $new_order->transaction_id = $preference->id;
        $new_order->total_order_price = $values['total'];
        $new_order->status = 'pending';
        $new_order->payment_method = $preference->operation_type;
        $new_order->payment_type = $preference->operation_type;

        $new_order->save();*/
        // ideia: criar a coluna só depois da resposta do checkout
       
        return json_encode(['success' => true, 'action' => 2, 'link' => $preference->sandbox_init_point]);
    }

    public function payment_success(){
        if(!isset($_GET['payment_id']) || !isset($_GET['preference_id'])){
            return redirect()->back();
        }

        $data = Http::withHeaders([
            'Authorization' => 'Bearer '. config('services.mercadopago.token'),
            'Content-Type'  => 'application/json'
        ])->get('https://api.mercadopago.com/v1/payments/'.$_GET['payment_id'])->json();

        if($data['status'] != 'approved' || $data['id'] != $_GET['payment_id']){
            return redirect()->back();
        }

        return Inertia::render('Payment/Success.vue', [
            'data' => $data
        ]);
    }

    public function payment_pending(){
        if(!isset($_GET['payment_id']) || !isset($_GET['preference_id'])){
            return redirect()->back();
        }

        $data = Http::withHeaders([
            'Authorization' => 'Bearer '. config('services.mercadopago.token'),
            'Content-Type'  => 'application/json'
        ])->get('https://api.mercadopago.com/v1/payments/'.$_GET['payment_id'])->json();

        if(!$data['status'] == 'in_process' || !$data['status'] == $_GET['payment_id']){
            return redirect()->back();
        }

        return Inertia::render('Payment/Pending.vue', [
            'data' => $data
        ]);
    }

    public function payment_fail(){
        if(!isset($_GET['payment_id']) || !isset($_GET['preference_id'])){
            return redirect()->back();
        }

        $data = Http::withHeaders([
            'Authorization' => 'Bearer '. config('services.mercadopago.token'),
            'Content-Type'  => 'application/json'
        ])->get('https://api.mercadopago.com/v1/payments/'.$_GET['payment_id'])->json();

        if($data['status'] != 'rejected' || $data['id'] != $_GET['payment_id']){
            return redirect()->back();
        }

        return Inertia::render('Payment/Fail.vue', [
            'data' => $data
        ]);
    }
}