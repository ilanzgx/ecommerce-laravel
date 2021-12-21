<?php

namespace App\Http\Controllers;

use App\Mail\ProductAssessment;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class WebhooksController extends Controller
{
    public function __invoke(Request $request){
        if(empty($request)){
            return http_response_code(200);
        }

        $data = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.mercadopago.token')
        ])->get('https://api.mercadopago.com/v1/payments/'. $request->data['id'])->json();
        
        $user = Customer::where('email', $data['payer']['email'])->first();
        $order = Order::where('payment_id', $request->data['id'])->first();

        if(!$order){

            $new_order = new Order();
            $new_order->customer_id = $user->id;
            $new_order->payment_id = $request->data['id'];
            $new_order->total_order_price = $data['transaction_amount'];
            $new_order->payment_method = $data['payment_method_id'];
            $new_order->payment_type = $data['payment_type_id'];
            $new_order->ip_address = $data['additional_info']['ip_address'];
            $new_order->status = $data['status'];
            $new_order->status_detail = $data['status_detail'];
            $new_order->external_reference = $data['external_reference'];
            $new_order->created_at = $data['date_created'];
            $new_order->updated_at = $data['date_last_updated'];

            $new_order->save();

        } else {

            $order->status = $data['status'];
            $order->status_detail = $data['status_detail'];

            $order->save();

            if($data['status'] == 'approved'){
                foreach($data['additional_info']['items'] as $item){
                    Mail::to($data['payer']['email'])->send(new ProductAssessment($data['id'], $item['id']));
                }
            }

        }
            
        return http_response_code(200);
    }
}
