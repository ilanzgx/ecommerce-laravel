<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProdutoController extends Controller
{
    public function index($produtoid = 0){
        $datas = Product::where('id', $produtoid)->get();
        return Inertia::render('Product', ['product' => $datas]);
    }
}
