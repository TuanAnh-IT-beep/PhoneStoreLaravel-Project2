<?php

namespace App\Http\Controllers;

use App\Models\Spec;
use App\Http\Requests\StoreSpecRequest;
use App\Http\Requests\UpdateSpecRequest;
use Illuminate\Support\Facades\Redirect;

class SpecController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specs = Spec::all();
        return view(
            'specs.index',
            [
                'specs' => $specs
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('specs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSpecRequest $request)
    {
        Spec::create([
            'name' => $request->name
        ]);
        return Redirect::route('specs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Spec $spec)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Spec $spec)
    {
        return view(
            'specs.edit',
            [
                'spec' => $spec
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSpecRequest $request, Spec $spec)
    {
        $spec->update([
            'name' => $request->name
        ]);
        return Redirect::route('specs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Spec $spec)
    {
        $spec->delete();
        return Redirect::route('specs.index');
    }
}
