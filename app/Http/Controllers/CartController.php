<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Subproduct;

class CartController
{
    public function showCart()
    {
        $cart = Session::get('cart', []);
        return view('clients.Cart', compact('cart'));
    }

    public function addToCart(Request $request, Subproduct $subproduct)
    {
        $cart = Session::get('cart', []);
        if (Session::has('cart')) {
            if (isset($cart[$subproduct->id])) {
                $cart[$subproduct->id]['stock']++;
            } else {

                $cart[$subproduct->id] = [
                    'id' => $subproduct->id,
                    'stock' => 1,
                    'name' => $subproduct->name,
                    'price' => $subproduct->price,
                    'thumbnail_path' => $subproduct->thumbnail_path
                ];
            }
            Session::put('cart', $cart);
        } else {
            $cart[$subproduct->id] = [
                'id' => $subproduct->id,
                'stock' => 1,
                'name' => $subproduct->name,
                'price' => $subproduct->price,
                'thumbnail_path' => $subproduct->thumbnail_path
                
            ];

        }
        Session::put('cart', $cart);
        return Redirect::route('cart');
    }
    public function removeProduct(Subproduct $subproduct){
        $cart = Session::get('cart', []);
        if(Session::has('cart')) {
            if(isset($cart[$subproduct->id])) {
            unset($cart[$subproduct->id]);
            Session::put('cart', $cart);
            }
        }
        return Redirect::route('cart');
    }
    public function deleteCart(){
        Session::forget('cart');
        return Redirect::route('cart');
    }
    public function plus(Subproduct $subproduct){
        $cart = Session::get('cart', []);
        if(Session::has('cart')) {
            if(isset($cart[$subproduct->id])) {
                $cart[$subproduct->id]['stock']++;
                Session::put('cart', $cart);
            }
        }
        return Redirect::route('cart');
    }
    public function minus(Subproduct $subproduct){
        $cart = Session::get('cart', []);
        if(Session::has('cart')) {
            if(isset($cart[$subproduct->id]) && $cart[$subproduct->id]['stock'] > 1) {
                $cart[$subproduct->id]['stock']--;
                Session::put('cart', $cart);
            }else{
                unset($cart[$subproduct->id]);
                Session::put('cart', $cart);
            }
        }
        return Redirect::route('cart');
    }

}
