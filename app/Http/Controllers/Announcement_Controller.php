<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class Announcement_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Announcement::with('createdBy');
        if($request->filled('status'))
            $query->where('status', $request->status);
        return response()->json($query->latest()->paginate(20));
    }

   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|string|max:255',
            'status' => ['nullable', Rule::in(['draft', 'published', 'archived'])],
            'published_at' => 'nullable|date',
            'expires_at' => 'nullable|date'
        ]);

        $data['created_by'] = Auth::id();
        $data['status'] = $data['status'] ?? 'draft';
        if($data['status'] == 'published' && !isset($data['published_at']))
            $data['published_at'] = now();

        return response()->json(Announcement::create($data)->load('created_by'), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Announcement $announcement)
    {
        return response()->json($announcement->load('created_by'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Announcement $announcement)
    {
        $data = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'image' => 'nullable|string|max:255',
            'status' => ['nullable', Rule::in(['draft', 'published', 'archived'])],
            'published_at' => 'nullable|date',
            'expires_at' => 'nullable|date'
        ]);

        $announcement->update($data);

        return response()->json($announcement->fresh()->load('crested_by'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement)
    {
        $announcement->update(['status' => 'archived']);
        return response()->json(['message' => 'Announcement archived.']);
    }
}
