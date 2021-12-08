<?php

namespace App\Http\Controllers;

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
        return Inertia::render('CustomerArea/MyData.vue', [
            'data' => $user,
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
}
