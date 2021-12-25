<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function address(){
        return $this->belongsTo(Address::class, 'customer_id', 'customer_id');
    }
}
