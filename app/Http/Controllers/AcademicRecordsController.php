<?php

namespace App\Http\Controllers;

use App\Models\Academic_Records;
use Illuminate\Http\Request;

class AcademicRecordsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Academic_Records::with('alumniProfile')->latest()->paginate(20));
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
            'alumni_profile_id' => 'required|exists:alumni_profile,id', 
            'institution' => 'required|string|max:200', 
            'degree' => 'required|string|max:150',
            'department' => 'nullable|string|max:150',
            'start_year' => 'nullable|integer|digits:4',
            'end_year' => 'nullable|integer|digits:4',
            'grade' => 'nullable|string|max:50',
            'cgpa' => 'nullable|numeric|between:0,4',
            'description' => 'nullable|string',
        ]);

        return response()->json(Academic_Records::create($data)->load('alumniProfile'), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Academic_Records $academic_Records)
    {
        return response()->json($academic_Records->load('alumniProfile'));
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
    public function update(Request $request, Academic_Records $academic_Records)
    {
        $data = $request->validate([
            'alumni_profile_id' => 'sometimes|exists:alumni_profile,id', 
            'institution' => 'sometimes|string|max:200', 
            'degree' => 'sometimes|string|max:150',
            'field_of_study' => 'nullable|string|max:150',
            'start_year' => 'nullable|integer|digits:4',
            'end_year' => 'nullable|integer|digits:4',
            'grade' => 'nullable|string|max:50',
            'cgpa' => 'nullable|numeric|between:0,4',
            'description' => 'nullable|string',
        ]);

        $academic_Records->update($data);
        return response()->json($academic_Records->fresh()->load('alumniProfile'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Academic_Records $academic_Record)
    {
        $academic_Record->delete();
        return response()->json(['message' => 'Record deleted successfully.']);
    }
}
