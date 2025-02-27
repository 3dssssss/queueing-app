<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserTicket;
use App\Models\Queue;

class CounterController extends Controller
{

public function show($counterId)
{
    // Fetch the counter details if needed
    $counter = Queue::findOrFail($counterId);

    // Retrieve all user tickets associated with the counter
    $tickets = UserTicket::where('ticket_counter', $counterId)->get();

    // Return the view with the tickets
    return view('user.counter', compact('tickets', 'counter'));
}
}
