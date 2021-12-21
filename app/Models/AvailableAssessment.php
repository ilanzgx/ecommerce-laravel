<?php

namespace App\Models;

use App\Mail\ProductAssessment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AvailableAssessment extends Model
{
    protected $table = 'available_assessment';

    public static function create_available_assessment($customerid, $paymentid, $productid){
        DB::table('available_assessment')->insert([
            'customer_id' => $customerid,
            'payment_id' => $paymentid,
            'product_id' => $productid,
            'token' => Customer::createHash(32, 2),
            'created_at' => Carbon::now()
        ]);

        $user = Customer::where('id', $customerid)->first();

        Mail::to($user->email)->send(new ProductAssessment($paymentid, $productid));

        return 1;
    }
}
