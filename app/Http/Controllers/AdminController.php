<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index(){
        if(session()->get('backoffice_permission')){
            return redirect()->route('admin.dashboard');
        }
        return Inertia::render('Admin/Index.vue');
    }

    public function dashboard(Request $request){ 
        //dd($request->session()->all());   
        return Inertia::render('Admin/Home.vue',['products' => Product::all()]);
    }

    public function signin(Request $request){
        $value = $request->password;

        if($value == config('app.master_password')){
            $response = [
                'success' => true,
                'message' => 'Sucesso'
            ];

            session(['backoffice_permission' => true]);

            return json_encode($response);
        }
        $response = [
            'success' => false,
            'message' => 'Erro'
        ];
        return json_encode($response);
    }

    public function create_product(Request $request){
        return $request;
    }

    public function remove_product(Request $request){
        return $request;
    }

    public function edit_product(Request $request){
        return $request;
    }
}
