<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use Illuminate\Support\Facades\Redirect;

class PermissionController
{
    /**
     * Display a listing of the resource.
     */
 public function index()
    {
        $permissions = Permission::all();
        return view(
            'admins.permissions.index',
            [
                'permissions' => $permissions
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionRequest $request)
    {
        Permission::create([
            'name' => $request->name,
            'description' => $request->description
        ]);
        return Redirect::route('admins.settings.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return view('admins.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $permission->update([
            'name' => $request->name,
            'description' => $request->description
        ]);
        return Redirect::route('admins.settings.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->roles()->detach();
        $permission->delete();
        return Redirect::route('admins.settings.index');
    }
}
