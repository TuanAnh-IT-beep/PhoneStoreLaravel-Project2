<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSpecRequest;
use App\Http\Requests\UpdateSpecRequest;
use App\Models\Spec;
use Illuminate\Support\Facades\Redirect;

class SpecController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specs = Spec::all();
        return view("admins.specs.index", compact("specs"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admins.specs.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSpecRequest $request)
    {
        Spec::create([
            'name' => $request->name,
            'suffix' => $request->suffix,
        ]);

        return Redirect::route('admins.settings.index')->with('success', 'Spec created successfully.');
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
        return view('admins.specs.edit', compact('spec'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSpecRequest $request, Spec $spec)
    {
        $spec->update([
            'name' => $request->name,
            'suffix' => $request->suffix,
        ]);
        return Redirect::route('admins.settings.index')->with('success', 'Spec updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Spec $spec)
    {
        $spec->delete();
        return Redirect::route('admins.settings.index')->with('success', 'Spec deleted successfully.');
    }
}
