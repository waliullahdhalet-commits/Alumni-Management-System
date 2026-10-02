<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Event_Registeration;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class Event_Registeration_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Event $event)
    {
        return response()->json($event->registerations()->with('user')->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Event $event)
    {
        if($event->capacity!==null && $event->registerations()->where('status', 'registered')->count()>=$event->capacity) {
            return response()->json(['message'=> "Event capacity reached."], 422);
        }
            

        $register = Event_Registeration::updateOrCreate([
            'event_id'=>$event->id,
            'user_id'=>$request->user()->id],
            ['status'=>'registered','registered_at'=>now()]);
        return response()->json($register->load('event','user'),201);
    }

    public function updateStatus(Request $request, Event_Registeration $event_Registeration)
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(['registered', 'cancelled', 'attended', 'absent'])]
        ]);

        $event_Registeration->update($data);
        return response()->json($event_Registeration->fresh());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event_Registeration $event_Registeration)
    {
        $event_Registeration->update(['status'=>'cancelled']);
        return response()->json(['message'=>'Registeration cancelled.']);
    }
}
