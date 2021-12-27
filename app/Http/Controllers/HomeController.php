<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $products = Product::with('assessments')->where('visible', '<>', 0)->get();

        if($products->isEmpty()){
            return Inertia::render('Home', ['empty' => true]);
        }
        return Inertia::render('Home', [
            'products' => $products,
            'empty' => false
        ]);
    }

    public function login(){
        if(isset($_GET['action']) && ($_GET['action'] == 1 || $_GET['action'] == 2)){
            return Inertia::render('Login', ['action' => $_GET['action']]);
        }
        session()->reflash();
        return Inertia::render('Login', [
            'flash' => session('_flash')
        ]);
    }

    public function show404(){
        return Inertia::render('Errors/404');
    }

    public function releases(){
        $products = Product::with('assessments')->orderBy('updated_at', 'desc')->where('visible', '<>', 0)->get();

        if($products->isEmpty()){
            return Inertia::render('Categories/Releases.vue', ['empty' => true]);
        }
        return Inertia::render('Categories/Releases.vue', [
            'products' => $products,
            'empty' => false
        ]);
    }

    public function highlights(){
        $products = Product::with('assessments')->orderBy('total_sold', 'desc')->where('visible', '<>', 0)->get();

        if($products->isEmpty()){
            return Inertia::render('Categories/Highlights.vue', ['empty' => true]);
        }
        return Inertia::render('Categories/Highlights.vue', [
            'products' => $products,
            'empty' => false
        ]);
    }

    public function topSellers(){
        $products = Product::with('assessments')->orderBy('total_sold', 'desc')->where('visible', '<>', 0)->get();

        if($products->isEmpty()){
            return Inertia::render('Categories/TopSellers.vue', ['empty' => true]);
        }
        return Inertia::render('Categories/TopSellers.vue', [
            'products' => $products,
            'empty' => false
        ]);
    }

    public function offers(){
        $products = Product::with('assessments')->orderBy('price', 'asc')->where('visible', '<>', 0)->get();

        if($products->isEmpty()){
            return Inertia::render('Categories/Offers.vue', ['empty' => true]);
        }
        return Inertia::render('Categories/Offers.vue', [
            'products' => $products,
            'empty' => false
        ]);
    }
}
