<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WebhooksController extends Controller
{
    public function __invoke(Request $request){
        $data = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.mercadopago.token')
        ])->get('https://api.mercadopago.com/v1/payments/'. $request->data->id)->json();

        $new_order = new Order();

        $new_order->customer_id = 1;
        $new_order->payment_id = $request->data->id;
        $new_order->total_order_price = $data['transaction_amount'];
        $new_order->payment_method = $data['payment_method_id'];
        $new_order->payment_type = $data['payment_type_id'];
        $new_order->ip_address = $data['additional_info']['ip_address'];
        $new_order->external_reference = $data['external_reference'];
        $new_order->created_at = $data['date_created'];
        $new_order->updated_at = $data['date_last_updated'];

        $new_order->save();
    }
}
