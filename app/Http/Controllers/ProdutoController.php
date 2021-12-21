<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProdutoController extends Controller
{
    public function index($produtoid = 0){
        $data = Product::where('id', $produtoid)->get();
        if($produtoid <= 0 || empty($data[0])){
            return redirect()->back();
        }

        $assessment = Assessment::where('product_id', $produtoid)->get();

        return Inertia::render('Product', [
            'product' => $data[0], 
            'assessments' => $assessment,
            'customer_data' => Customer::where('id', $assessment->customer_id)->first(),
            'app_name' => config('app.name')
        ]);
    }
}
