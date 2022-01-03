<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Customer extends Model
{
    protected $table = 'customers';

    public function assessments(){
        return $this->hasMany(Assessment::class, 'customer_id', 'id');
    }

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
            'last_name' => '',
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

    public static function update_address_customer($customer_id, $data){
        
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.mercadopago.token')
        ])->put('https://api.mercadopago.com/v1/customers/' . $customer_id, [
            'default_address' => 'Home',
            'address' => [
                'id' => $data['identificacao'],
                'zip_code' => $data['cep'],
                'street_name' => $data['logradouro'],
                'street_number' => $data['numero']
            ]
        ]);

        return $response->json();
        
    }
}
