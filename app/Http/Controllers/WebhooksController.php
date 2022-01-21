<?php

namespace App\Http\Controllers;

use App\Mail\ProductAssessment;
use App\Models\AvailableAssessment;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            $new_order->logistic_status = Order::getLogisticStatus($data['status']);
            $new_order->external_reference = $data['external_reference'];
            $new_order->created_at = $data['date_created'];
            $new_order->updated_at = $data['date_last_updated'];

            $new_order->save();

            foreach($data['additional_info']['items'] as $item){
                DB::table('products')->where('id', $item['id'])->decrement('stock', $item['quantity']);
                DB::table('products')->where('id', $item['id'])->increment('total_sold', $item['quantity']);
            }

        } else {

            $order->status = $data['status'];
            $order->status_detail = $data['status_detail'];
            $order->logistic_status = Order::getLogisticStatus($data['status']);

            $order->save();

        }

        /*if($data['status'] == 'approved'){
            foreach($data['additional_info']['items'] as $item){
                AvailableAssessment::create_available_assessment($user->id, $request->data['id'], $item['id']);
            }
        }*/

        if($data['status'] == 'expired' || $data['status'] == 'cancelled' || $data['status'] == 'fail'){
            foreach($data['additional_info']['items'] as $item){
                DB::table('products')->where('id', $item['id'])->increment('stock', $item['quantity']);
                DB::table('products')->where('id', $item['id'])->decrement('total_sold', $item['quantity']);
            }
        }
            
        return http_response_code(200);
    }
}
