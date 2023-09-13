<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::get();
        return view('products.index', ['products' => $products]);
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $req){

        $req->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg,bmp,gif|max:1000'
        ]);
        
        $imageName = time().'.'.$req->image->extension();
        $req->image->move(public_path('products'), $imageName);

        $product = new Product;
        $product->name = $req->name;
        $product->description = $req->description;
        $product->image = $imageName;

        $product->save();

        return back()->withSuccess('Product Created !!');
    }

    public function edit($id){

        $product = Product::where('id', $id)->first();

        return view('products.edit', ['product' => $product]);
    }

    public function update(Request $req, $id){

        $product = Product::where('id', $id)->first();

        $req->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg,bmp,gif|max:1000'
        ]);

        if(isset($req->image)){
            $imageName = time().'.'.$req->image->extension();
            $req->image->move(public_path('products'), $imageName);
            $product->image = $imageName;
        }

        $product->name = $req->name;
        $product->description = $req->description;

        $product->save();

        return back()->withSuccess('Product Updated !!');
    }

    public function delete($id) {
        
        $product = Product::where('id', $id)->first();

        $product->delete();

        return back()->withSuccess('Product Deleted !!');
    }
}
