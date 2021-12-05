<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index(){
        if(session()->get('backoffice_permission')){
            return redirect()->route('admin.dashboard');
        }
        return Inertia::render('Admin/Index.vue');
    }

    public function dashboard(Request $request){  
        return Inertia::render('Admin/Home.vue', [
            'products' => Product::all(),
            'orders'   => Order::all()
        ]);
    }

    public function signin(Request $request){
        $value = $request->password;

        if($value == config('app.master_password')){
            $response = [
                'success' => true,
                'message' => 'Sucesso'
            ];

            session(['backoffice_permission' => true]);

            return json_encode($response);
        }
        $response = [
            'success' => false,
            'message' => 'Erro'
        ];
        return json_encode($response);
    }

    public function create_product(Request $request){
        $values = [
            'image'       =>     $request->image,
            'name'        =>     $request->name,
            'description' =>     $request->description,
            'price'       =>     $request->price,
            'old_price'   =>     $request->old_price,
            'category'    =>     $request->category,
            'stock'       =>     $request->stock
        ];

        // Convert base64 to image
        $b64 = $values['image'];
        $formated = explode(',', $b64);
        $data = base64_decode($formated[1]);
        
        $im = imagecreatefromstring($data);

        if(!$im){
            die('Base64 value is not a valid image');
        }
        
        $filename = Product::createHash(32, 2);
        if($formated[0] == 'data:image/jpeg;base64'){

            $img_file = "storage/products/$filename.jpg";
            imagejpeg($im, $img_file, 0);

        } else if($formated[0] == 'data:image/png;base64'){

            $img_file = "storage/products/$filename.png";

            $trans = imagecolorallocatealpha($im, 0, 0, 0, 127);
            imagesavealpha($im, true);
            imagefill($im, 0, 0, $trans);

            imagepng($im, $img_file);

        } else {
            die('error is not png even jpg');
        }

        $values['image'] = '/'.$img_file;
        
        // sql
        Product::create_new_product($values);

        return json_encode(['success' => true]);
    }

    public function remove_product(Request $request){
        $productid = $request->id;

        $product = Product::find($productid);
        $product->delete();
        
        return json_encode(['success' => true]);
    }

    public function edit_product(Request $request){
        return $request;
    }

    
}
