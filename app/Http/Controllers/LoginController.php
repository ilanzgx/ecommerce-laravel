<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function signin(Request $request){
        $data = [
            'email' => filter_var($request->email, FILTER_SANITIZE_EMAIL),
            'password' => $request->password
        ];

        $user = Usuario::where('email', $data['email'])->first();
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
        $novo_usuario = new Usuario();
        
        $novo_usuario->full_name = $request->full_name;
        $novo_usuario->email = $request->email;
        $novo_usuario->password = Hash::make($request->password);
        $novo_usuario->genre = $request->genre;
        $novo_usuario->birth_date = $request->birth_date;
        $novo_usuario->cpf = $request->cpf;
        $novo_usuario->perfil = "usuario";

        $novo_usuario->save();
    }
}
