<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubproductRequest;
use App\Http\Requests\UpdateSubproductRequest;
use App\Models\Product;
use App\Models\Spec;
use App\Models\Subproduct;
use App\Models\SubSpec;

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
        $specs = Spec::all();
        $product->load('images');

        return view('admins.subproducts.create', compact('product', 'specs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubproductRequest $request)
    {
        $subproduct = Subproduct::create($request->all());
        if ($request->has('specs')) {
            $addedSpecs = [];
            foreach ($request->specs as $specData) {
                if (! empty($specData['spec_id']) && ! empty($specData['value'])) {
                    if (! in_array($specData['spec_id'], $addedSpecs)) {
                        SubSpec::create([
                            'subproduct_id' => $subproduct->id,
                            'spec_id' => $specData['spec_id'],
                            'value' => $specData['value'],
                        ]);
                        $addedSpecs[] = $specData['spec_id'];
                    }
                }
            }
        }

        return redirect()->route('subproducts.index', $subproduct->product_id)->with('success', 'Subproduct created successfully.');
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
    public function edit(Product $product, Subproduct $subproduct)
    {
        $specs = Spec::all();
        $product->load('images');
        $subproduct->load('sub_specs');
        return view('admins.subproducts.edit', compact('product', 'subproduct', 'specs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubproductRequest $request, Product $product, Subproduct $subproduct)
    {
        $thumbnail_path = $subproduct->thumbnail_path;
        if ($request->has('thumbnail_path')) {
            $thumbnail_path = $request->thumbnail_path;
        }

        $subproduct->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'thumbnail_path' => $thumbnail_path
        ]);

        $processedSpecIds = []; // To avoid duplicate spec_id from request

        if ($request->has('specs')) {
            foreach ($request->input('specs', []) as $specData) {
                if (empty($specData['spec_id']) || ! isset($specData['value']) || $specData['value'] === '') {
                    continue;
                }
                if (in_array($specData['spec_id'], $processedSpecIds)) {
                    continue;
                }
                $exists = SubSpec::where('subproduct_id', $subproduct->id)
                    ->where('spec_id', $specData['spec_id'])
                    ->exists();
                if ($exists) {
                    SubSpec::where('subproduct_id', $subproduct->id)
                        ->where('spec_id', $specData['spec_id'])
                        ->update(['value' => $specData['value']]);
                } else {
                    SubSpec::create([
                        'subproduct_id' => $subproduct->id,
                        'spec_id' => $specData['spec_id'],
                        'value' => $specData['value'],
                    ]);
                }
                $processedSpecIds[] = $specData['spec_id'];
            }
        }

        // Delete all sub_specs that were not processed
        $subproduct->sub_specs()->whereNotIn('spec_id', $processedSpecIds)->delete();

        return redirect()->route('subproducts.index', $subproduct->product_id)->with('success', 'Subproduct updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, Subproduct $subproduct)
    {
        $subproduct->delete();

        return redirect()->route('subproducts.index', $subproduct->product_id)->with('success', 'Subproduct deleted successfully.');
    }
}
