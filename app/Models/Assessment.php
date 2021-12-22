<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $table = 'assessments';

    public function user(){
        return $this->belongsTo(Customer::class);
    }
}
