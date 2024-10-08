<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Assessment;
use App\Models\AvailableAssessment;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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

        $product = Product::all();
        $name = [];
        $total_sold = [];
        foreach($product as $value){
            $name[] = "'{$value['name']}'";
            $total_sold[] = $value['total_sold'];
        }

        $name = implode(',', $name);
        $total_sold = implode(',', $total_sold);

        return Inertia::render('Admin/Home.vue', [
            'dashboard' => [
                'customers_count' => $customers->count(),
                'total_value'     => Order::where('status', 'approved')->sum('total_order_price'),
                'chart_products_name'  => ltrim($name),
                'chart_products_sold'  => ltrim($total_sold),
            ],
            'products'        => Product::all(),
            'orders'          => Order::orderBy('created_at')->with('customer')->get(),
            'orders_accepted' => Order::with('customer', 'address')->whereIn('logistic_status', [2,3])->get(),
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
            imagejpeg($im, $img_file, 0);

        } else if($formated[0] == 'data:image/png;base64'){

            $img_file = "storage/products/$filename.png";

            $trans = imagecolorallocatealpha($im, 0, 0, 0, 127);
            imagesavealpha($im, true);
            imagefill($im, 0, 0, $trans);

            // remove after presentation
            imagepng($im, $img_file);

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

        $assessments = Assessment::where('product_id', $productid)->get();
        foreach($assessments as $item){
            $item->delete();
        }

        $assessments_available = AvailableAssessment::where('product_id', $productid)->get();
        foreach($assessments_available as $item){
            $item->delete();
        }

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

        $product = Product::where('id', $request->id)->first();

        if(!$product){
            return json_encode([
                'success' => false,
                'message' => 'Produto não existe'
            ]);
        }

        if($values['image'] != $product->image){
            if($values['image'] == null){
                return json_encode([
                    'success' => false,
                    'message' => 'Escolha uma imagem'
                ]);
            }
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
                imagejpeg($im, $img_file, 0);

            } else if($formated[0] == 'data:image/png;base64'){

                $img_file = "storage/products/$filename.png";

                $trans = imagecolorallocatealpha($im, 0, 0, 0, 127);
                imagesavealpha($im, true);
                imagefill($im, 0, 0, $trans);

                // remove after presentation
                imagepng($im, $img_file);

            } else {
                die('error is not png even jpg');
            }

            $values['image'] = '/'.$img_file;
        }

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

        $order = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.mercadopago.token')
        ])->get('https://api.mercadopago.com/v1/payments/'. $data->payment_id)->json();

        $data->save();

        $customer = Customer::where('email', $order['payer']['email'])->first();

        if($order['status'] == 'approved'){
            foreach($order['additional_info']['items'] as $item){
                AvailableAssessment::create_available_assessment($customer->id, $order['id'], $item['id']);
            }
        }
        return json_encode(['success' => true]);
    }

    public function get_order_data(Request $request){
        try{

            $messages = [
                'id.required' => 'O campo id de pagamento é obrigatório',
                'id.numeric' => 'O campo id de pagamento deve ser apenas números',
            ];

            $request->validate([
                'id' =>        'required|numeric',
            ], $messages);

        } catch(ValidationException $e) {
            return json_encode(['errors' => $e->errors()]);
        }

        $data = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.mercadopago.token')
        ])->get('https://api.mercadopago.com/v1/payments/'. $request->id)->json();

        if($data['status'] == 404){
            return json_encode([
                'success' => false,
                'message' => 'ID de pagamento invalido'
            ]);
        }

        return json_encode([
            'success' => true,
            'data' => $data
        ]);
    }

    public function get_data_chart(){
        $products = Product::all();

        $data = [];
   
        foreach($products as $item){
            $tmp = [
                'productid' => $item['id'],
                'total_sold' => $item['total_sold']
            ];

            array_push($data, $tmp);
        }

        return json_encode(['data' => $data]);
    }
}
