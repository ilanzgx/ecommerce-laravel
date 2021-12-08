<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    protected $table = 'products';

    public static function search_products_by_ids($ids){
        return DB::select("select * from products where id in ($ids)");
    }

    public static function create_new_product($data){
        $product = new Product();

        $product->name = $data['name'];
        $product->description = $data['description'];
        $product->image = $data['image'];
        $product->price = $data['price'];
        
        if($data['old_price'] > 0){
            $product->old_price = $data['old_price'];
            $product->discount = 1;
        } else {
            $product->old_price = $data['old_price'];
            $product->discount = 0;
        }

        $product->stock = $data['stock'];
        $product->category = $data['category'];

        $product->save();
        return $data;
    }

    public static function createHash($num_chars, $complexity){
        $chars = [
            'abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz',
            'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
            'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ012345678901234567890123456789'
        ];

        return substr(str_shuffle($chars[$complexity]), 0, $num_chars);
    }
}