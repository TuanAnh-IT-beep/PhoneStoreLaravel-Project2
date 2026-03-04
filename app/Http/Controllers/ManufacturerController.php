<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use App\Http\Requests\StoreManufacturerRequest;
use App\Http\Requests\UpdateManufacturerRequest;
use Illuminate\Support\Facades\Redirect;

class ManufacturerController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $manufacturers = Manufacturer::all();
        return view(
            'manufacturers.index',
            [
                'manufacturers' => $manufacturers
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manufacturers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreManufacturerRequest $request)
    {
        Manufacturer::create([
            'name' => $request->name,
            'description' => $request->description,
            'icon' => $request->icon
        ]);
        return Redirect::route('manufacturers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Manufacturer $manufacturer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Manufacturer $manufacturer)
    {
        return view(
            'manufacturers.edit',
            [
                'manufacturer' => $manufacturer
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateManufacturerRequest $request, Manufacturer $manufacturer)
    {
        $manufacturer->update([
            'name' => $request->name,
            'description' => $request->description,
            'icon' => $request->icon
        ]);
        return Redirect::route('manufacturers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Manufacturer $manufacturer)
    {
        $manufacturer->delete();
        return Redirect::route('manufacturers.index');
    }
}
