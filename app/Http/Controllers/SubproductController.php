<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Subproduct;
use App\Http\Requests\StoreSubproductRequest;
use App\Http\Requests\UpdateSubproductRequest;

class SubproductController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        $subproducts = $product->subproducts;
        return view('admins.subproducts.index', compact('subproducts', 'product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Product $product)
    {
        return view('admins.subproducts.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubproductRequest $request)
    {
        $subproduct = Subproduct::create($request->all());
        return redirect()->route('subproducts.index', $subproduct->product_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subproduct $subproduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subproduct $subproduct)
    {
        return view('admins.subproducts.edit', compact('subproduct'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubproductRequest $request, Subproduct $subproduct)
    {
        $subproduct->update($request->all());
        return redirect()->route('subproducts.index', $subproduct->product_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subproduct $subproduct)
    {
        $subproduct->delete();
        return redirect()->route('subproducts.index', $subproduct->product_id);
    }
}
