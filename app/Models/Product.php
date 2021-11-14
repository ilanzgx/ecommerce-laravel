<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $table = 'products';

    public static function search_products_by_ids($ids){
        return DB::select("select * from `products` where `id` in ($ids)");
    }
}
