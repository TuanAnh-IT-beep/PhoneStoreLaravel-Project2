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
        return view('clients.ViewAll', compact('subproducts'));
    }
    public function showByCategory($id){
        $category=Category::FindOrFail($id);
        $products= $category->products;
        return view('clients.ViewAll',compact('category','products'));
    }
    public function showById($id){
        $product_byID=Product::FindOrFail($id);
        return view('clients.ViewAll',compact('product_byID'));
    }
    public function detail($proid, $subid){
        $product=Product::FindOrFail($proid);
        $subproduct=Subproduct::FindOrFail($subid);
        $subproducts=$product->subproducts;
        $specs=Subspec::with('subproduct')->get();
        return view('clients.Detail',compact('subproduct','subproducts','specs'));
    }
}
