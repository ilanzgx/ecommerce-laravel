<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProdutoController extends Controller
{
    public function index($produtoid = 0){
        $datas = Produto::where('id', $produtoid)->get();
        return Inertia::render('Produto', ['datas' => $datas]);
    }
}
