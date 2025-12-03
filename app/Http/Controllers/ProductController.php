<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Products;

class ProductController extends Controller
{
    public function index(){
        return view('products.index');
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'sku' => 'required|unique:products,sku',
            'price' =>'required|numeric',
            'status' => 'required',
            'image' =>'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if($validator->fails()){
            return redirect(route('products.create'))->withErrors($validator)->withInput();
        }

        $product = new Products();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->status = $request->status;
        $product->save();

        return redirect(route('products.index'))->with('success', 'product created successfully');
    }
}
