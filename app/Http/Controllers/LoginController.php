<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function signin(Request $request){
        $data = [
            'email' => filter_var($request->email, FILTER_SANITIZE_EMAIL),
            'password' => $request->password
        ];

        $user = Customer::where('email', $data['email'])->first();
        if(!$user){

            $response = [
                'message' => 'Essa conta não existe',
                'success' => false
            ];

            return json_encode($response);
        }

        if(Hash::check($data['password'], $user->password)){
            $response = [
                'message' => 'Logado com sucesso',
                'success' => true
            ];

            session([
                'email'  => $request->email,
                'logged' => true,
                'role'   => 'administrador'
            ]);

            return json_encode($response);
        } else {
            $response = [
                'message' => 'Senha incorreta',
                'success' => false
            ];

            return json_encode($response);
        }
    }

    public function signup(Request $request){
        $new_customer = new Customer();
        
        $new_customer->full_name = $request->full_name;
        $new_customer->email = $request->email;
        $new_customer->password = Hash::make($request->password);
        $new_customer->genre = $request->genre;
        $new_customer->birth_date = $request->birth_date;
        $new_customer->cpf = $request->cpf;
        $new_customer->role = 'usuario';

        $new_customer->save();

        session([
            'email'  => $request->email,
            'logged' => true,
            'role'   => 'administrador'
        ]);
    }
}
