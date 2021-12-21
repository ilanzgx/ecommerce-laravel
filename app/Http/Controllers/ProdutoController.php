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
        $data = Product::where('id', $produtoid)->get();
        if($produtoid <= 0 || empty($data[0])){
            return redirect()->back();
        }

        $assessments = DB::table('assessments')->where('product_id', $produtoid)->get();

        if($assessments->isEmpty()){
            return Inertia::render('Product', [
                'product' => $data[0], 
                'app_name' => config('app.name')
            ]);
        }

        return Inertia::render('Product', [
            'product' => $data[0], 
            'assessments' => $assessments,
            'app_name' => config('app.name')
        ]);
    }
}
