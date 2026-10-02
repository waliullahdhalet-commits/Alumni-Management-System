<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Role::withCount('users')->get());
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
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|string|max:50|unique:roles,name', 
            'description'=>'nullable|string|max:255'
        ]);

        return response()->json(Role::create($data), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return response()->json($role->load('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name'=>'required|string|max:50|unique:roles,name,'
            .$role->id,
            'description'=>'nullable|string|max:255'
        ]);

        $role->update($data);

        return response()->json($role->fresh());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        abort_if($role->users()->exists(), 422, "Unable to delete the role.");

        $role->delete();

        return response()->json([
            'message'=>'Role deleted.'
        ]);
    }
}
