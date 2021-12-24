<?php

namespace App\Http\Controllers;

use App\Mail\OrderPlaced;
use App\Mail\OrderShipped;
use App\Mail\ProductAssessment;
use App\Models\Address;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Rules\FullName;
use App\Rules\ValidGenre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
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
        session()->reflash();
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
            'address' => $address,
            'flash' => session('_flash')
        ]);
    }

    public function orders(){
        $user = Customer::where('email', session('email'))->first();
        $data = Order::orderBy('created_at', 'desc')->where('customer_id', $user->id)->get();
        return Inertia::render('CustomerArea/Orders.vue', [
            'data' => $data
        ]);
    }

    public function myassessment($token){
        $data = DB::table('available_assessment')->where('token', $token)->first();

        if($token !== $data->token){
            return redirect()->route('index');
        }

        return Inertia::render('CustomerArea/MyAssessment.vue', [
            'token' => $token,
            'product_data' => Product::where('id', $data->product_id)->first()
        ]);
    }

    public function changedata(Request $request){

        try{
            $messages = [
                'name.required' => 'O campo nome é obrigatório.',
                'email.required' => 'O campo email é obrigatório.',
                'genre.required' => 'O campo genre é obrigatório.',
                'birth_date.required' => 'O campo data de nascimento é obrigatório.',
                'cpf.required' => 'O campo CPF é obrigatório.',                
            ];

            $validator = $request->validate([
                'name' => ['required', new FullName],
                'email' => 'required|email',
                'genre' => ['required', new ValidGenre],
                'birth_date' => 'required',
                'cpf' => 'required|cpf|formato_cpf',
                'number' => 'celular_com_ddd'
            ], $messages);

        } catch(ValidationException $e) {
            return json_encode(['errors' => $e->errors()]);
        }

        $values = [
            'name'       => $request->name,
            'email'      => $request->email,
            'genre'      => $request->genre,
            'birth_date' => $request->birth_date,
            'cpf'        => $request->cpf,
            'number'     => $request->number
        ];

        $user = Customer::where('email', $values['email'])->first();

        $user->full_name = $values['name'];
        $user->email = $values['email'];
        $user->genre = $values['genre'];
        $user->birth_date = $values['birth_date'];
        $user->cpf = $values['cpf'];
        $user->number = $values['number'];
        $user->save();

        return json_encode(['success' => true]);
    }

    public function changeaddress(Request $request){
        try{
            $messages = [
                'cep.required' => 'O campo CEP é obrigatório.',
                'identificacao.required' => 'O campo indentificação é obrigatório.',
                'logradouro.required' => 'O campo logradouro é obrigatório.',
                'numero.required' => 'O campo numero é obrigatório.',
                'complemento.required' => 'O campo complemento é obrigatório.',
                'ponto_referencia.required' => 'O campo ponto de referencia é obrigatório.',
                'bairro.required' => 'O campo bairro é obrigatório.',
                'cidade.required' => 'O campo cidade é obrigatório.',
                'uf.required' => 'O campo UF(sigla do estado) é obrigatório.',
            ];

            $validator = $request->validate([
                'cep'              => 'required|formato_cep',
                'identificacao'    => 'required',
                'logradouro'       => 'required',
                'numero'           => 'required|numeric',
                'complemento'      => 'required',
                'ponto_referencia' => 'required',
                'bairro'           => 'required',
                'cidade'           => 'required',
                'uf'               => 'required|uf'
            ], $messages);

        } catch(ValidationException $e) {
            return json_encode(['errors' => $e->errors()]);
        }

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

        $customer = Customer::where('email', session('email'))->first();
        Customer::update_address_customer($customer->customer_id, $values);

        return json_encode(['success' => true]);
    }
}
