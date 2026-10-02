<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class Workshop_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Workshop::with('createdBy');
        if($request->filled('status'))
            $query->where('status', $request->status);
        return response()->json($query->orderBy('workshop_date')->paginate(20));
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'=>'required|string|max:200',
            'description'=>'nullable|string',
            'instructor'=>'nullable|string|max:200',
            'mode'=>['required',Rule::in(['physical','online','hybrid'])],
            'venue'=>'nullable|string|max:255',
            'meeting_url'=>'nullable|url|max:500',
            'workshop_date'=>'required|date',
            'start_time'=>'required|date_format:H:i',
            'end_time'=>'nullable|date_format:H:i',
            'registration_deadline'=>'nullable|date',
            'image'=>'nullable|string|max:255',
            'status'=>['nullable',Rule::in(['draft','published','cancelled','completed'])]]);

            $data['created_by']=Auth::id();
            return response()->json(Workshop::create($data)->load('createdBy'),201);
           
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Workshop $workshop)
    {
        return response()->json($workshop->load('createdBy', 'registrations'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Workshop $workshop)
    {
        $data = $request->validate([
            'title'=>'sometimes|required|string|max:200',
            'description'=>'nullable|string',
            'instructor'=>'nullable|string|max:200',
            'mode'=>['sometimes','required',Rule::in(['physical','online','hybrid'])],
            'venue'=>'nullable|string|max:255',
            'meeting_url'=>'nullable|url|max:500',
            'workshop_date'=>'sometimes|required|date',
            'start_time'=>'sometimes|required|date_format:H:i',
            'end_time'=>'nullable|date_format:H:i',
            'registration_deadline'=>'nullable|date',
            'image'=>'nullable|string|max:255',
            'status'=>['nullable',Rule::in(['draft','published','cancelled','completed'])
            ]]);

        $workshop->update($data);
        return response()->json($workshop->fresh()->load('createdBy'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workshop $workshop)
    {
        $workshop->delete();
        return response()->json(['message'=>'Workshop deleted.']);
    }
}
