<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Produto;

class HomeController extends Controller
{
    public function index(){
        $produtos = Produto::all()->toArray();
        //echo '<pre>';
        //print_r($produtos);
        return Inertia::render('Home', ['datas' => $produtos]);
    }

    public function carrinho(){
        return Inertia::render('Cart');
    }

    public function login(){
        return Inertia::render('Login');
    }
}
