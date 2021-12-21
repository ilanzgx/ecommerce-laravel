<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ProductAssessment extends Mailable
{
    use Queueable, SerializesModels;
    protected $productid;
    protected $paymentid;

    public function __construct($paymentid, $productid){
        $this->paymentid = $paymentid;
        $this->productid = $productid;
    }

    public function build(){
        $product_data = DB::select("select * from products where id=:id", ['id' => $this->productid]);

        $payment_data = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.mercadopago.token')
        ])->get('https://api.mercadopago.com/v1/payments/'. $this->paymentid)->json();

        return $this->view('Mail.product_assessment', [
            'product_data' => $product_data[0],
            'payment_data' => $payment_data
        ]);
    }
}
