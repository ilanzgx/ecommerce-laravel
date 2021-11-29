<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProdutoController extends Controller
{
    public function index($produtoid = 0){
        $data = Product::where('id', $produtoid)->get();
        //dd($data);
        if($produtoid <= 0 || empty($data[0])){
            return redirect()->back();
        }
        return Inertia::render('Product', ['product' => $data[0], 'app_name' => config('app.name')]);
    }
}
