<?php

namespace App\Http\Controllers;

use App\Models\Alumni_Profile;
use Illuminate\Http\Request;

class Alumni_Profile_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Alumni_Profile::with('user');
        foreach(['department', 'program', 'batch', 'graduation_year', 'current_status', 'city', 'country'] as $field)
            if($request->filled($field))
                $data->where($field, $request->$field);
            if($request->filled('search'))
                $data->where(fn($query)=>$query->where('student_id', 'like', "%{$request->search}%")
                ->orWhere('first_name', 'like', "%{$request->search}%")
                ->orWhere('first_name', 'like', "%{$request->search}%"));

        return response()->json($data->latest()->paginate(20));
    }

    /**
     * Display the specified resource.
     */
    public function show(Alumni_Profile $alumni_Profile)
    {
        return response()->json($alumni_Profile->load(['user', 'academicRecords', 'workExperiences', 'publications', 'successStories', 'alumniCards']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alumni_Profile $alumni_Profile)
    {
        $data = $request->validate([
            'student_id' => 'sometimes|required|string|max:50|unique:alumni_profiles, student_id'.$alumni_Profile->id,
            'first_name'=>'sometimes|required|string|max:100',
            'last_name'=>'sometimes|required|string|max:100',
            'phone'=>'nullable|string|max:30',
            'gender'=>'nullable|in:male,female,other,prefer_not_to_say',
            'date_of_birth'=>'nullable|date',
            'address'=>'nullable|string',
            'city'=>'nullable|string|max:100',
            'country'=>'nullable|string|max:100',
            'linkedin_url'=>'nullable|url|max:255',
            'about'=>'nullable|string',
            'admission_year'=>'nullable|integer|digits:4',
            'graduation_year'=>'nullable|integer|digits:4',
            'cgpa'=>'nullable|numeric|between:0,4',
            'current_status'=>'nullable|in:employed,self_employed,entrepreneur,higher_studies,looking_for_job,freelancer,researcher,retired,other',
            'current_company'=>'nullable|string|max:150',
            'current_designation'=>'nullable|string|max:150',
        ]);

        $alumni_Profile->update($data);
        return response()->json($alumni_Profile->fresh()->load('user'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alumni_Profile $alumni_Profile)
    {
        $alumni_Profile->delete();
        return response()->json(['message'=>'Alumni profile moved to trash.']);
    }
}
