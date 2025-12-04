<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Products;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    public function index(){
        $products = products::orderBy('created_at','desc')
                    ->get();
        return view('products.index',['products'=>$products]);
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

        if($request->hasFile('image')){
            $image = $request->image;

            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'),$imageName);
            $product->image = $imageName;
            $product->save();
            
        };

        return redirect(route('products.index'))->with('success', 'product created successfully');
    }

    public function edit($id){
        $product = Products::findOrFail($id);
        return view('products.edit',['product'=>$product]);
    }

    public function update($id,Request $request){
        $product = Products::findOrFail($id);
        $oldImage = $product->image;


         $validator = Validator::make($request->all(),[
            'name' => 'required',
            'sku' => 'required|unique:products,sku'.$id,
            'price' =>'required|numeric',
            'status' => 'required',
            'image' =>'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if($validator->fails()){
            return redirect()->route('products.edit', $product->id)
                 ->withErrors($validator)
                 ->withInput();

        }

        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->status = $request->status;
        $product->save();

        if($request->hasFile('image')){

            if($oldImage != null && File::exists(public_path('/uploads/products/'.$oldImage))){
                File::delete(public_path('uploads/products/'.$oldImage));
            }


            $image = $request->image;
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'),$imageName);

            $product->image = $imageName;
            $product->save();
            
        }

        return redirect(route('products.index'))->with('success', 'product updated successfully');
    }

    public function destroy($id){
        $product = Products::findOrFail($id);

        if($product->image != null && File::exists(public_path('uploads/products/'.$product->image))){

             File::delete(public_path('uploads/products/'.$product->image));

              

        }

            $product->delete();
           
            return redirect(route('products.index'))->with('success', 'product deleted successfully');
    }

    
}
