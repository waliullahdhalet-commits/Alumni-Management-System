<?php

namespace App\Http\Controllers;

use App\Models\Alumni_Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class Alumni_Card_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Alumni_Card::with('alumniProfile', 'issuedBy')->latest()->paginate(20));
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
            'alumni-profile_id' => 'required|exists:alumni_profiles,id',
            'card_number' => 'nullable|string|max:50|unique:alumni_cards,card_number',
            'issue_date' => 'rquired|date',
            'expiry_date' => 'nullable|date',
            'status' => ['nullable', Rule::in(['pending', 'active', 'expired', 'suspended', 'lost', 'cancelled'])],
            'qr_code' => 'nullable|string|max:255'
        ]);

        $data['card_number'] = $data['card_number']??'ALM-'.strtoupper(Str::random(10));
        $data['issued_by']=Auth::id();
        $data['status']=$data['status']??'active';
        $data['issued_at']=now();

        return response()->json(Alumni_Card::create($data)->load('alumniProfile', 'issuedBy'), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Alumni_Card $alumni_Card)
    {
        return response()->json($alumni_Card->load('alumniProfile', 'issuedBy'));
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
    public function update(Request $request, Alumni_Card $alumni_Card)
    {
        $data = $request->validate([
            'issue_date'=>'sometimes|required|date',
            'expiry_date'=>'nullable|date',
            'status'=>['nullable',Rule::in(['pending','active','expired','suspended','lost','cancelled'])],
            'qr_code'=>'nullable|string|max:255']);
           
            $alumni_Card->update($data);
            
            return response()->json($alumni_Card->fresh());
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alumni_Card $alumni_Card)
    {
        $alumni_Card->update(['status'=>'cancelled']);

        return response()->json(['message'=>'Alumni Card Cancelled.']);
    }
}
