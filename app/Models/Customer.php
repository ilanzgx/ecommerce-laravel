<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Customer extends Model
{
    protected $table = 'customers';

    public static function createHash($num_chars, $complexity){
        $chars = [
            'abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz',
            'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
            'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ012345678901234567890123456789'
        ];

        return substr(str_shuffle($chars[$complexity]), 0, $num_chars);
    }

    public static function create_customer($data){

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.mercadopago.token')
        ])->post('https://api.mercadopago.com/v1/customers', [
            'email' => $data['email'],
            'first_name' => $data['full_name'],
            'last_name' => 'aaaaa',
            'identification' => [
                'type' => 'CPF',
                'number' => $data['identification']['number'],
            ],
            "date_registered" => $data['date_registered'],
            "description" => "Description del user",
            "default_card" => "None"
        ]);

        return $response->json();
    }

    public static function search_customer($customer_id){
        
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.mercadopago.token')
        ])->get('https://api.mercadopago.com/v1/customers/'. $customer_id);

        return (object)$response->json();

    }

    public static function update_customer($customer_id){
        
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.mercadopago.token')
        ])->put('https://api.mercadopago.com/v1/customers/' . $customer_id, [
            'first_name' => 'Ilan',
            'last_name' => 'Silva',
            'phone' => [
                'area_code' => "86",
                'number' => '999794220'
            ],
            'identification' => [
                'type' => 'CPF',
                'number' => '06025012377',
            ],
            'default_address' => 'Home',
            'address' => [
                'id' => 'Casa',
                'zip_code' => '64082440',
                'street_name' => 'Rua estrela do norte',
                'street_number' => 1665
            ],
            "date_registered" => "2000-01-18",
            "description" => "Description del user",
        ]);

        return $response->json();

    }
}
