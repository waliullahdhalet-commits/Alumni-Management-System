<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class Event_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Event::with('createdBy');
        if($request->filled('status'))
            $query->where('status', $request->status);
        return response()->json($query->orderBy('event_date')->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_type' => ['required', Rule::in(['meetup', 'seminar', 'webinar', 'job_fair', 'reunion', 'other'])],
            'event_mode' => ['required', Rule::in(['physical', 'online', 'hybrid'])],
            'venue' => 'nullable|string|max:255',
            'meeting_url' => 'nullable|url|max:500',
            'event_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'registeration_deadline' => 'nullable|date',
            'image' => 'nullable|string|max:255',
            'status' => ['nullable', Rule::in(['draft', 'published', 'completed', 'cancelled'])]
        ]);

        $data['created_by'] = Auth::id();
        return response()->json(Event::create($data)->load('createdBy'), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return response()->json($event->load('createdBy', 'registerations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'event_type' => ['sometimes', Rule::in(['meetup', 'seminar', 'webinar', 'job_fair', 'reunion', 'other'])],
            'event_mode' => ['sometimes', Rule::in(['physical', 'online', 'hybrid'])],
            'venue' => 'nullable|string|max:255',
            'meeting_url' => 'nullable|url|max:500',
            'event_date' => 'sometimes|date',
            'start_time' => 'sometimes|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'registeration_deadline' => 'nullable|date',
            'image' => 'nullable|string|max:255',
            'status' => ['nullable', Rule::in(['draft', 'published', 'completed', 'cancelled'])]
        ]);

        $event->update($data);
        return response()->json($event->fresh()->load('createdBy'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json(['message' => 'Event Deleted.']);
    }
}
