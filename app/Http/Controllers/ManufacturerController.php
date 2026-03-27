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
            'admins.manufacturers.index',
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
        return view('admins.manufacturers.create');
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
        return redirect()->route('manufacturers.index')->with('success', 'Manufacturer created successfully.');
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
            'admins.manufacturers.edit',
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
        return redirect()->route('manufacturers.index')->with('success', 'Manufacturer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Manufacturer $manufacturer)
    {
        $manufacturer->delete();
        return redirect()->route('manufacturers.index')->with('success', 'Manufacturer deleted successfully.');
    }
}
