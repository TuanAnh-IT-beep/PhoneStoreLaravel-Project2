<?php

namespace App\Http\Controllers;

use App\Models\Subproduct;
use App\Http\Requests\StoreSubproductRequest;
use App\Http\Requests\UpdateSubproductRequest;

class SubproductController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubproductRequest $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubproductRequest $request, Subproduct $subproduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subproduct $subproduct)
    {
        //
    }
}
