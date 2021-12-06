<?php

namespace App\Http\Controllers;

use App\Models\Product;
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

    public function releases(){
        $releases = DB::table('products')->orderBy('created_at', 'asc')->take(10)->get();
        return Inertia::render('Categories/Releases.vue', [
            'products' => $releases
        ]);
    }

    public function highlights(){
        $highlights = DB::table('products')->orderBy('created_at', 'asc')->take(10)->get();
        return Inertia::render('Categories/Highlights.vue', [
            'products' => $highlights
        ]);
    }

    public function topSellers(){
        return Inertia::render('Categories/TopSellers.vue');
    }

    public function offers(){
        return Inertia::render('Categories/Offers.vue');
    }
}
