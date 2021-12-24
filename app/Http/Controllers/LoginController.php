<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Mail\AccountVerify;
use App\Mail\PasswordForget;
use App\Models\Customer;
use App\Rules\FullName;
use App\Rules\ValidGenre;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Monolog\Handler\IFTTTHandler;

class LoginController extends Controller
{

    public function verification($token){
        $user = Customer::where('purl_code', $token)->first();

        if(!isset($user['status']) || empty($token) || $user['status'] == 'verificado'){
            return redirect()->route('index');
        }

        if($user && $user['purl_code'] == $token){

            $user->status = 'verificado';
            $user->save();

            return Inertia::render('CustomerArea/AccountVerification.vue');
        }

        return redirect()->back();
    }

    public function signin(Request $request){
        
        try{
            $messages = [
                'email.required' => 'O campo email é obrigatório.',
                'email.email' => 'Digite um email válido',
                'password.required' => 'O campo senha é obrigatório.',
            ];

            $validator = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ], $messages);

        } catch(ValidationException $e) {
            return json_encode(['errors' => $e->errors()]);
        }
        
        $user = Customer::where('email', $request->email)->first();
        if(!$user){
            $response = [
                'message' => 'Essa conta não existe',
                'success' => false
            ];

            return json_encode($response);
        }

        if(Hash::check($request->password, $user->password)){
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

        try{
            $messages = [
                'full_name.required' => 'O campo nome é obrigatório.',
                'email.required' => 'O campo email é obrigatório.',
                'password.required' => 'O campo senha é obrigatório.',
                'genre.required' => 'O campo gênero é obrigatório.',
                'birth_date.required' => 'O campo data de nascimento é obrigatório.',
                'cpf.required' => 'O campo CPF é obrigatório.',
                'password.confirmed' => 'A confirmação da senha não bateu com a senha'
            ];

            $validator = $request->validate([
                'full_name' => ['required', new FullName],
                'email' => 'required|email',
                'password' => 'required|confirmed',
                'genre' => ['required', new ValidGenre],
                'birth_date' => 'required',
                'cpf' => 'required|cpf|formato_cpf'
            ], $messages);

        } catch(ValidationException $e) {
            return json_encode(['errors' => $e->errors()]);
        }

        $user = Customer::where('email', $request->email)->first();

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
            $new_customer->cpf = preg_replace( '/[^0-9]/', '', $request->cpf);
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
            //$new_customer->customer_id = 'teste';
            // save new customer
            $new_customer->save();

            $response = [
                'success' => true,
                'message' => 'Registrado com sucesso',
            ];

            session([
                'email'  => $request->email,
                'logged' => true,
                'name'   => $request->full_name,
                'role'   => 'usuario'
            ]);

            // send email
            Mail::to($request->email)->send(new AccountVerify());

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

    public function forget_password(Request $request){
        try{

            $messages = [
                'emailModal.required' => 'O campo email é obrigatório.',
                'emailModal.email' => 'O campo email deve ter um email válido',
            ];

            $request->validate([
                'emailModal' => 'required|email'
            ], $messages);

        } catch(ValidationException $e){
            return json_encode(['errors' => $e->errors()]);
        }

        $user = Customer::where('email', $request->emailModal)->first();

        if($user){

            $generateToken = Customer::createHash(32, 2);

            DB::table('password_resets')->insert([
                'email' => $request->emailModal,
                'token' => $generateToken,
                'created_at' => Carbon::now()
            ]);

            Mail::to($request->emailModal)->send(new PasswordForget($generateToken));

            return json_encode(['success' => true, 'message' => 'Link enviado através de seu email!']);

        } else {
            return json_encode(['success' => false, 'message' => 'Não existe nenhuma conta com esse email']);
        }
    }

    public function change_password($token){
        $trueToken = DB::table('password_resets')->where('token', $token)->first();
        
        if($token !== $trueToken->token){
            return redirect()->route('index');
        }

        return Inertia::render('ResetPassword', [
            'token' => $token
        ]);
    }

    public function reset_password(Request $request){
        try{

            $messages = [
                'email.required' => 'O campo email é obrigatório.',
                'password.required' => 'O campo nova senha é obrigatório.',
                'email.email' => 'O campo email deve ter um email válido',
                'password.confirmed' => 'As senhas não batem'
            ];

            $request->validate([
                'email' => 'required|email',
                'password' => 'required|confirmed',
            ], $messages);

        } catch(ValidationException $e){
            return json_encode(['errors' => $e->errors()]);
        }

        $trueToken = DB::table('password_resets')->where('token', $request->token)->first();

        if($trueToken->email != $request->email){
            return json_encode(['success' => false, 'message' => 'Email inválido']);
        }

        $user = Customer::where('email', $request->email)->first();

        $user->password = Hash::make($request->password);

        $user->save();

        return json_encode(['success' => true, 'message' => 'Senha trocada']);
    }
}
