<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

use function PHPUnit\Framework\isEmpty;

class ProdutoController extends Controller
{
    public function index($produtoid = 0){
        $product = Product::where('id', $produtoid)->first();

        if(!$product){
            return redirect()->route('index');
        }

        $var = [];
        $assessments = $product->assessments()->get();

        if($assessments->isEmpty()){
            return Inertia::render('Product', [
                'product' => $product, 
                'empty' => true,
                'app_name' => config('app.name')
            ]);
        }

        foreach($assessments as $assessment){
            $data = Assessment::with('product', 'customer')->where('id', $assessment->id)->get();
            array_push($var, $data);
        }

        return Inertia::render('Product', [
            'product' => $product, 
            'assessments' => $var,
            'empty' => false,
            'app_name' => config('app.name')
        ]);
    }
}
