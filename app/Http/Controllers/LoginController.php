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
                'name'   => $user->full_name,
                'role'   => $user->role
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
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $user = Customer::where('email', $data['email'])->first();

        if($user){
            
            $response = [
                'success' => false,
                'message' => 'Email já existente',
            ];

            return json_encode($response);

        } else {

            $new_customer = new Customer();
            
            $new_customer->full_name = $request->full_name;
            $new_customer->email = $request->email;
            $new_customer->password = Hash::make($request->password);
            $new_customer->genre = $request->genre;
            $new_customer->birth_date = $request->birth_date;
            $new_customer->cpf = $request->cpf;
            $new_customer->role = 'usuario';
            $new_customer->status = 'nao-verificado';
            $new_customer->purl_code = Customer::createHash(16, 2);

            // create customer on api
            $values = [
                'full_name' => $request->full_name,
                'email' => $request->email,
                'identification' => [
                    'type' => 'CPF',
                    'number' => $request->cpf
                ],
                "date_registered" => date(DATE_ATOM, mktime(0, 0, 0, 7, 1, 2000))
            ];
            $req = Customer::create_customer($values);

            $new_customer->customer_id = $req['id'];
            // save new customer
            $new_customer->save();

            $response = [
                'success' => true,
                'message' => 'Registrado com sucesso',
            ];

            // send email

            session([
                'email'  => $request->email,
                'logged' => true,
                'name'   => $request->full_name,
                'role'   => 'usuario'
            ]);

            return json_encode($response);
        }

        $response = [
            'success' => false,
            'message' => 'Erro',
        ];

        return json_encode($response);
    }

    public function header_session(Request $request){
        return json_encode($request->session()->all());
    }

    public function logout(Request $request){
        $request->session()->flush();
        return json_encode(['success' => true]);
    }
}
