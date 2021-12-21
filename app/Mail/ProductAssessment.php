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
        $trueToken = DB::table('available_assessment')
            ->where('payment_id', '=', $this->paymentid)
            ->where('product_id', '=', $this->productid)->first();

        return $this->view('Mail.product_assessment', [
            'token' => $trueToken->token
        ]);
    }
}
