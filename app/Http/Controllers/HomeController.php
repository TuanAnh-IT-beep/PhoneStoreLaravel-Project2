<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subproduct;
use App\Models\SubSpec;
class HomeController
{
    public function index()
    {
        $subproducts = Subproduct::all();
        $products = Product::all();
        $categories = Category::all();
        return view('clients.index', compact('products', 'categories', 'subproducts'));
    }
    public function showAll(){
        $subproducts = Subproduct::with('product')->get();
        $products = Product::all();
        $categories = Category::all();
        $spec =SubSpec::all();
        return view('clients.view', compact('subproducts', 'spec'));
    }
    public function showByCategory($cateid){
        return view('clients.view', compact('cateid'));
    }
    public function showById($id){
        return view('clients.view',compact('id'));
    }
    public function detail($proid, $subid){
        $product=Product::FindOrFail($proid);
        $subproduct=Subproduct::FindOrFail($subid);
        $subproducts=$product->subproducts;
        $specs=Subspec::with('subproduct')->get();
        return view('clients.detail',compact('subproduct','subproducts','specs'));
    }

}
