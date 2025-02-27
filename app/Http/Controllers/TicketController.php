<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function create(Request $request)
    {
        //NOT WORKING
        // Validate the incoming request
        $request->validate([
            'ticket_number' => 'required|string|max:255|unique:tickets',
            'service' => 'required|string|max:255',
        ]);

        // Create a new ticket
        Ticket::create([
            'ticket_number' => $request->ticket_number,
            'service' => $request->service,
            'user_id' => auth()->id(), // Assuming you have user authentication
            'status' => 'open', // Default status
        ]);

        return redirect()->back()->with('success', 'Ticket created successfully!');
    }
    
}
