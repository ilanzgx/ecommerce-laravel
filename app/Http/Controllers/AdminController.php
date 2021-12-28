<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index(){
        if(session()->get('backoffice_permission')){
            return redirect()->route('admin.dashboard');
        }
        return Inertia::render('Admin/Index.vue');
    }

    public function dashboard(){  
        $customers = Customer::orderBy('role', 'desc')->get();
        return Inertia::render('Admin/Home.vue', [
            'dashboard' => [
                'customers_count' => $customers->count(),
                'total_value'     => Order::where('status', 'approved')->sum('total_order_price')
            ],
            'products'        => Product::all(),
            'orders'          => Order::orderBy('created_at')->with('customer')->get(),
            'orders_accepted' => Order::with('customer', 'address')->whereIn('logistic_status', [2,3,4])->get(),
            'users'           => $customers,
            'categories'      => Category::all()
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

        try{
            $messages = [
                'name.required' => 'O campo nome é obrigatório.',
                'description.required' => 'O campo descrição é obrigatório.',
                'price.required' => 'O campo preço é obrigatório.',
                'category.required' => 'O campo categoria é obrigatório.',
                'stock.required' => 'O campo estoque é obrigatório.',
            ];

            $validator = $request->validate([
                'name'        => 'required',
                'description' => 'required',
                'price'       => 'required',
                'category'    => 'required',
                'stock'       => 'required|numeric',
                
            ], $messages);

        } catch(ValidationException $e) {
            return json_encode(['errors' => $e->errors()]);
        }

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
            // remove after presentation
            //imagejpeg($im, $img_file, 0);

        } else if($formated[0] == 'data:image/png;base64'){

            $img_file = "storage/products/$filename.png";

            $trans = imagecolorallocatealpha($im, 0, 0, 0, 127);
            imagesavealpha($im, true);
            imagefill($im, 0, 0, $trans);

            // remove after presentation
            //imagepng($im, $img_file);

        } else {
            die('error is not png even jpg');
        }

        $values['image'] = '/'.$img_file;
        
        // sql
        $aaa = Product::create_new_product($values);
        

        return json_encode(['success' => true, 'message' => 'Produto criado com sucesso']);
    }

    public function remove_product(Request $request){
        $productid = $request->id;

        $product = Product::find($productid);
        $product->delete();
        
        return json_encode(['success' => true]);
    }

    public function edit_product(Request $request){
        
        try{
            $messages = [
                'name.required' => 'O campo nome é obrigatório.',
                'description.required' => 'O campo descrição é obrigatório.',
                'price.required' => 'O campo preço é obrigatório.',
                //'category.required' => 'O campo categoria é obrigatório.',
                'stock.required' => 'O campo estoque é obrigatório.',
            ];

            $request->validate([
                'name'        => 'required',
                'description' => 'required',
                'price'       => 'required',
                //'category'    => 'required',
                'stock'       => 'required|numeric',
                
            ], $messages);

        } catch(ValidationException $e) {
            return json_encode(['errors' => $e->errors()]);
        }

        $values = [
            'id'          =>     $request->id,
            'image'       =>     $request->image,
            'name'        =>     $request->name,
            'description' =>     $request->description,
            'price'       =>     $request->price,
            'old_price'   =>     $request->old_price,
            'category'    =>     $request->category_id,
            'stock'       =>     $request->stock
        ];

        $product = Product::where('id', $values['id'])->first();

        $product->image = $values['image'];
        $product->name = $values['name'];
        $product->description = $values['description'];
        $product->price = $values['price'];
        $product->old_price = $values['old_price'];
        $product->category_id = $values['category'];
        $product->stock = $values['stock'];

        $product->save();

        return json_encode([
            'success' => true,
            'message' => 'Produto editado com sucesso'
        ]);
    }

    public function create_category(Request $request){

        try{

            $messages = [
                'name.required' => 'O campo nome é obrigatório',
                'description.required' => 'O campo descrição é obrigatório'
            ];

            $request->validate([
                'name' =>        'required',
                'description' => 'required'
            ], $messages);

        } catch(ValidationException $e) {
            return json_encode(['errors' => $e->errors()]);
        }

        $new_category = new Category();

        $new_category->name = $request->name;
        $new_category->description = $request->description;

        $new_category->save();

        return json_encode(['success' => true, 'message' => 'Categoria criada com sucesso']);
    }

    public function get_product_data(Request $request){
        $data = Product::where('id', $request->productid)->first();

        return json_encode([
            'success'=> true,
            'image' => $data->image,
            'name'  => $data->name,
            'description' => $data->description,
            'price' => $data->price,
            'old_price' => $data->old_price,
            'category_id' => $data->category_id,
            'stock' => $data->stock
        ]);
    }

    public function set_product_visible(Request $request){
        $data = Product::where('id', $request->id)->first();

        if($data->visible){
            $data->visible = false;
        }else{
            $data->visible = true;
        }

        $data->save();
        return json_encode(['success' => true]);
    }

    public function set_order_sended(Request $request){
        $data = Order::where('id', $request->id)->first();

        if($data->logistic_status == 2){
            $data->logistic_status = 3;
        }else{
            $data->logistic_status = 2;
        }

        $data->save();
        return json_encode(['success' => true]);
    }

    public function set_order_received(Request $request){
        $data = Order::where('id', $request->id)->first();

        $data->logistic_status = Order::ENTREGUE;

        $data->save();
        return json_encode(['success' => true]);
    }
}
