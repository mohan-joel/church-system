<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meeting;
use App\Models\Agenda;
use App\Models\Attendee;
use App\Models\Decision;

class MeetingController extends Controller
{
    //
    public function show()
    {
        $a = 1;
        $year = date('Y');
        return view('user.meetings',compact('year'));
    }

    public function store(Request $request)
    {
        
        // Validate the incoming request data
        $validatedData = $request->validate([
            'date' => 'required|date',
            'description' => 'required|string',
            'agendas.*.description' => 'required|string',
            'decisions.*.description' => 'required|string',
            'attendees.*.name' => 'required|string',
        ]);

        // Create a new meeting
        $meeting = Meeting::create([
            'date' => $validatedData['date'],
            'description' => $validatedData['description'],
        ]);

        // Add agendas to the meeting
        foreach ($validatedData['agendas'] as $agendaData) {
            $agenda = new Agenda(['description' => $agendaData['description']]);
            $meeting->agendas()->save($agenda);
        }

        // Add decisions to the meeting
        foreach ($validatedData['decisions'] as $decisionData) {
            $decision = new Decision(['description' => $decisionData['description']]);
            $meeting->decisions()->save($decision);
        }

        // Add attendees to the meeting
        foreach ($validatedData['attendees'] as $attendeeData) {
            $attendee = new Attendee(['attendees_name' => $attendeeData['name']]);
            $meeting->attendees()->save($attendee);
        }

        // Redirect or return a response as needed
        return redirect('/show-meetings')->with('success', 'Meeting added successfully');
    
    }
}
