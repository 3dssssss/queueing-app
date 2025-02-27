<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use App\Models\UserTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class QueueController extends Controller
{
    // Show the form to create a new queue
    public function create()
    {
        return view('admin.queue.create.index'); 
    }

    // Store a new queue in the database
    public function store(Request $request)
    {
        // dd($request->all()); 

        // Validate the incoming request data
        $request->validate([
            'queue_name' => 'required|string|max:255',
            'queue_type' => 'required|in:General,Priority,Appointment-based',
            'queue_code' => 'required|string|unique:queue_create,queue_code|max:255',
            'department' => 'string|max:255',
            'ticket_counter' => 'string|max:255',
        ]);

        try {
            // Create a new queue record
            Queue::create([
                'queue_name' => $request->queue_name,
                'queue_type' => $request->queue_type,
                'queue_code' => $request->queue_code,
                'department' => $request->department ?? 'City Treasurer\'s Office',
                'ticket_counter' => $request->ticket_counter,
            ]);

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Queue created successfully!');
        } catch (\Exception $e) {
            // Redirect back with an error message
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
    // Display all queues
    public function view()
    {
        // Fetch all queues from the database
        $queues = Queue::all();
        return view('admin.queue.view.view', compact('queues'));
    }

    // Show the edit form
    public function edit($id)
    {
        $queue = Queue::findOrFail($id); // Fetch the queue item by ID
        return view('admin.queue.edit.edit', compact('queue')); // Pass the queue item to the view
    }

    // Handle the update request
    public function update(Request $request, $id)
    {
        // dd($request->all());

        $queue = Queue::findOrFail($id);

        // Validate the request data
        $request->validate([
            'queue_name' => 'required|string|max:255',
            'queue_type' => 'required|in:General,Priority,Appointment-based',
            'queue_code' => 'required|string|max:255|unique:queue_create,queue_code,' . $queue->id,
            'department' => 'nullable|string|max:255',
            'ticket_counter' => 'string|max:255',
        ]);

        $queue->update($request->only(['queue_name', 'queue_type', 'queue_code', 'department', 'ticket_counter']));

        // Redirect to the appropriate route after update
        return redirect()->route('admin.queue.view.view')->with('success', 'Queue updated successfully.'); // Adjust the route name as needed
    }

    public function destroy($id)
{
    try {
        // Find the queue by ID
        $queue = Queue::findOrFail($id);
        
        // Delete the queue record
        $queue->delete();
        
        // Redirect back with a success message
        return redirect()->route('admin.queue.view.view')->with('success', 'Queue deleted successfully.');
    } catch (\Exception $e) {
        // In case of error, redirect with an error message
        return redirect()->route('admin.queue.view.view')->with('error', 'Error: ' . $e->getMessage());
    }
}

    public function dashboard()
    {
        $queue = Queue::all();

        return view('dashboard', compact('queue')); 
    }

    public function submitQueue(Request $request)
    {        
        // Validate the incoming request
        $request->validate([
            'ticket_number' => 'required|string|max:255',
            'service' => 'required|exists:queue_create,id', 
            'notes' => 'nullable|string|max:1000',
        ]);
        
        Queue::create([
            'queue_name' => $request->service,
            'queue_code' => $request->ticket_number,
            'notes' => $request->notes,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Queue submitted successfully!');
    }
    
    // public function display()
    // {
    //     $ticket_counter = Queue::latest()->get(); 
    //     return view('display-counter', compact('ticket_counter')); 
    // }

    public function displayCounter()
{
    $ticket = \App\Models\UserTicket::where('user_id', Auth::id())
        ->where('status', 'active')
        ->first();

    if (!$ticket) {
        return redirect()->route('display');
    }

    $counter = \App\Models\Queue::where('id', $ticket->queue_id)->first();

    if (!$counter) {
        return redirect()->route('display')->with('error', 'No counter found for your ticket.');
    }

    return view('display-counter', ['ticket_counter' => $counter]); 
}

public function toggleAllQueues(Request $request)
{
    // Get the current status of queues (assumes all queues have the same status)
    $anyActive = Queue::where('status', 'active')->exists();

    // If any queue is active, pause all; otherwise, activate all
    $newStatus = $anyActive ? 'paused' : 'active';

    // Update all queues
    Queue::query()->update(['status' => $newStatus]);

    // Return updated status as JSON response
    return response()->json(['status' => $newStatus]);
}

// public function showProceedModal()
// {
//     $user = auth()->user(); // Get the logged-in user
//     $previousQueue = $user->latestTicket->queue_name ?? null; // Get last used queue

//     $counters = Queue::all(); // Fetch all counters from queue_create table

//     return view('display-completed', compact('counters', 'previousQueue'));
// }

// public function show($counterId)
// {

//     $counter = Queue::findOrFail($counterId);

//     $tickets = UserTicket::where('ticket_counter', $counterId)->get();

//     // Return the view with the tickets
//     return view('user.counter', compact('tickets', 'counter'));
// }

// public function index()
// {
//     $counters = Queue::all();

//     // Return the view with the counters
//     return view('user.counter', compact('counters'));
// }



}



