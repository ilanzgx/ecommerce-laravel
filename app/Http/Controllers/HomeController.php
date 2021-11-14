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
       
        return Inertia::render('Home', ['products' => $produtos]);
    }

    public function login(){
        return Inertia::render('Login');
    }

    public function show404(){
        return Inertia::render('Errors/404');
    }
}
