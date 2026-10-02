<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userData = User::with(['role', 'alumniProfile']);

        if($request->filled('status'))
            $userData->where('status',$request->status);

        if($request->filled('search'))
            $userData->where(fn($x)=>$x
            ->where('name','like',"%{$request->search}%")
            ->orWhere('email','like',"%{$request->search}%"));

        return response()->json($userData->latest()->paginate(20));
    }

    

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json($user->load('role','alumniProfile'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(Request $request, User $user)
    {
        $data = $request->validate(['status'=>['required', Rule::in(['active', 'pending', 'suspended', 'rejected'])]]);
        $user->update($data);
        return response()->json($user->fresh()->load('role', 'alumniProfile'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message'=>'User moved to trash.']);
    }
}
