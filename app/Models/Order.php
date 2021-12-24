<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
