<?php

namespace App\Http\Controllers;

use App\Models\Work_Experience;
use Illuminate\Http\Request;

class Work_Experience_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Work_Experience::with('alumni_Profile')->latest()->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'alumni_profile_id' => 'required|exists:alumni_profiles,id',
            'company_name' => 'required|string|max:200',
            'designation' => 'required|string|max:150',
            'employment_type' => 'required|in:full_time,part_time,internship,contract,remote',
            'location' => 'nullable|string|max:150',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'currently_working' => 'boolean',
            'job_description' => 'nullable|string',
        ]);

        return response()->json(Work_Experience::create($data)->load('alumni_Profile'), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Work_Experience $work_Experience)
    {
        return response()->json($work_Experience->load('alumni_Profile'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Work_Experience $work_Experience)
    {
        $data = $request->validate([
            'alumni_profile_id' => 'sometimes|exists:alumni_profiles,id',
            'company_name' => 'sometimes|string|max:200',
            'designation' => 'sometimes|string|max:150',
            'employment_type' => 'sometimes|in:full_time,part_time,internship,contract,remote',
            'location' => 'nullable|string|max:150',
            'start_date' => 'sometimes|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'currently_working' => 'boolean',
            'job_description' => 'nullable|string',
        ]);

        $work_Experience->update($data);

        return response()->json($work_Experience->fresh()->load('alumni_Profile'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Work_Experience $work_Experience)
    {
        $work_Experience->delete();

        return response()->json(['message' => 'Record deleted successfully.']);
    }
}
