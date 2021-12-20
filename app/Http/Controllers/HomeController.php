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
        if(isset($_GET['action']) && ($_GET['action'] == 1 || $_GET['action'] == 2)){
            return Inertia::render('Login', ['action' => $_GET['action']]);
        }
        return Inertia::render('Login');
    }

    public function show404(){
        return Inertia::render('Errors/404');
    }

    public function releases(){
        $releases = DB::table('products')->orderBy('created_at', 'asc')->take(10)->get();
        if($releases->isEmpty()){
            return Inertia::render('Categories/Releases.vue', ['empty' => true]);
        }
        return Inertia::render('Categories/Releases.vue', [
            'products' => $releases
        ]);
    }

    public function highlights(){
        $highlights = DB::table('products')->orderBy('created_at', 'asc')->take(10)->get();
        if($highlights->isEmpty()){
            return Inertia::render('Categories/Highlights.vue', ['empty' => true]);
        }
        return Inertia::render('Categories/Highlights.vue', [
            'products' => $highlights
        ]);
    }

    public function topSellers(){
        $topsellers = DB::table('products')->orderBy('created_at', 'asc')->take(10)->get();
        if($topsellers->isEmpty()){
            return Inertia::render('Categories/TopSellers.vue', ['empty' => true]);
        }
        return Inertia::render('Categories/TopSellers.vue', [
            'products' => $topsellers
        ]);
    }

    public function offers(){
        $offers = DB::table('products')->orderBy('created_at', 'asc')->take(10)->get();
        if($offers->isEmpty()){
            return Inertia::render('Categories/Offers.vue', ['empty' => true]);
        }
        return Inertia::render('Categories/Offers.vue', [
            'products' => $offers
        ]);
    }
}
