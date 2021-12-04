<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $produtos = DB::table('products')->orderBy('stock', 'desc')->get();
        if($produtos->isEmpty()){
            return Inertia::render('Home', ['empty' => true]);
        }
        return Inertia::render('Home', ['products' => $produtos, 'empty' => false]);
    }

    public function login(){
        return Inertia::render('Login');
    }

    public function show404(){
        return Inertia::render('Errors/404');
    }
}
