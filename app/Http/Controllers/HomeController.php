<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Produto;

class HomeController extends Controller
{
    public function index(){
        $produtos = Produto::all()->toArray();
        return Inertia::render('Home', ['datas' => $produtos]);
    }

    public function carrinho(){
        echo '<pre>';
        print_r(session()->all());
        return Inertia::render('Cart', ['datas' => session()->all()]);
    }

    public function login(){
        return Inertia::render('Login');
    }

    public function show404(){
        return Inertia::render('Errors/404');
    }
}
