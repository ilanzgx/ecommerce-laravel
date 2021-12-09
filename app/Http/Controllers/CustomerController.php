<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CustomerController extends Controller
{
    public function myaccount(){
        $user = Customer::where('email', session('email'))->first();
        $user_id = $user->id;
        $lastOrder = DB::select("select * from orders where customer_id=$user_id order by id desc");
        if(empty($lastOrder)){
            $lastOrder[0] = null;
        }
        return Inertia::render('CustomerArea/MyAccount.vue', [
            'data' => $user,
            'lastOrder' => $lastOrder[0]
        ]);
    }

    public function mydata(){
        $user = Customer::where('email', session('email'))->first();
        $address = Address::where('customer_id', $user->id)->first();
        if(empty($address)){
            $address = new Address();

            $address->cep = null;
            $address->identificacao = null;
            $address->logradouro = null;
            $address->numero = null;
            $address->complemento = null;
            $address->ponto_referencia = null;
            $address->bairro = null;
            $address->cidade = null;
            $address->uf = null;
        }

        return Inertia::render('CustomerArea/MyData.vue', [
            'data' => $user,
            'address' => $address
        ]);
    }

    public function changedata(Request $request){
        $values = [
            'name'       => $request->name,
            'email'      => $request->email,
            'genre'      => $request->genre,
            'birth_date' => $request->birth_date,
            'cpf'        => $request->cpf,
            'number'     => $request->number
        ];

        $user = Customer::where('email', $values['email'])->first();

        if(!empty($values['name'])){
            $user->full_name = $values['name'];
        }

        if(!empty($values['email'])){
            $user->email = $values['email'];
        }

        if(!empty($values['genre'])){
            $user->genre = $values['genre'];
        }

        if(!empty($values['birth_date'])){
            $user->birth_date = $values['birth_date'];
        }

        if(!empty($values['cpf'])){
            $user->cpf = $values['cpf'];
        }

        if(!empty($values['number'])){
            $user->number = $values['number'];
        }

        $user->save();

        return json_encode(['success' => true]);
    }

    public function changeaddress(Request $request){

        $values = [
            'bairro'           => $request->bairro,
            'cep'              => $request->cep,
            'identificacao'    => $request->identificacao,
            'cidade'           => $request->cidade,
            'complemento'      => $request->complemento,
            'logradouro'       => $request->logradouro,
            'numero'           => $request->numero,
            'ponto_referencia' => $request->ponto_referencia,
            'uf'               => $request->uf,
        ];

        $myUser = Customer::where('email', session('email'))->first();

        $address_typed = Address::where('customer_id', $myUser->id)->first(); 
        if($address_typed){ // if already exists

            $address_typed->district = $values['bairro'];
            $address_typed->cep = $values['cep'];
            $address_typed->identification = $values['identificacao'];
            $address_typed->city = $values['cidade'];
            $address_typed->complement = $values['complemento'];
            $address_typed->logradouro = $values['logradouro'];
            $address_typed->number = $values['numero'];
            $address_typed->reference_point = $values['ponto_referencia'];
            $address_typed->uf = $values['uf'];

            $address_typed->save();

        } else { // if not

            $address = new Address();

            $address->district = $values['bairro'];
            $address->cep = $values['cep'];
            $address->customer_id = $myUser->id;
            $address->identification = $values['identificacao'];
            $address->city = $values['cidade'];
            $address->complement = $values['complemento'];
            $address->logradouro = $values['logradouro'];
            $address->number = $values['numero'];
            $address->reference_point = $values['ponto_referencia'];
            $address->uf = $values['uf'];

            $address->save();

        }

        return json_encode(['success' => true]);
    }
}
