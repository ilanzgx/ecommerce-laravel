<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produto extends Model
{
    protected $table = 'produtos';

    public static function search_products_by_ids($ids){
        return DB::select("select * from `produtos` where `id` in ($ids)");
    }
}
