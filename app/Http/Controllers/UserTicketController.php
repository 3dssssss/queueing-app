<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserTicket;
use App\Models\Setting;
use App\Models\Queue;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notifications\UserTurnNotification;
use App\Models\User;




class UserTicketController extends Controller
{
    public function create()
    {
        $queue = Queue::all();
        return view('dashboard', compact('queue'));
    }

    public function store(Request $request)
    {
 
        $request->validate([
            'queue_id' => 'required|exists:queue_create,id',
            'ticket_number' => 'required|unique:user_tickets,ticket_number',
            'notes' => 'nullable|string',
        ]);

        $user = Auth::user(); 
        $queue = Queue::findOrFail($request->queue_id); 
        $ticketNumber = UserTicket::generateTicketNumber($queue->queue_code);

        $expirationMinutes = Setting::first()->ticket_expiration_minutes ?? 30;
        $expirationTime = now()->addMinutes($expirationMinutes);

        UserTicket::create([
            'user_id' => $user->id,
            'queue_id' => $queue->id,
            'ticket_number' => $request->ticket_number,
            'name' => $user->name,
            'email' => $user->email,
            'notes' => $request->notes,
            'expires_at' => $expirationTime,
            'phone' => $user->phone,
            'age' => $user->age,
            'gender' => $user->gender,
        ]);

        return redirect()->route('dashboard')->with('success', 'Ticket created successfully');
    }

    public function getLatestTicket($queue_id)
{
    $queue = Queue::findOrFail($queue_id);
    
    $latestTicket = UserTicket::where('queue_id', $queue_id)
        ->latest('id')
        ->first();

    if ($latestTicket) {
        preg_match('/-(\d+)$/', $latestTicket->ticket_number, $matches);
        $latestNumber = $matches ? (int) $matches[1] : 0;
    } else {
        $latestNumber = 0;
    }

    return response()->json(['latest_number' => $latestNumber]);
}

public function display()
{
    $tickets = UserTicket::where('user_id', Auth::id())
        ->where('expires_at', '>', now())
        ->orderBy('ticket_number', 'asc')
        ->get();

    $activeTicket = $tickets->where('status', 'active')->first();

    if ($activeTicket) {
        return redirect()->route('display-counter');
    }

    return view('display', compact('tickets'));
}


 public function view()
 {
    $tickets = UserTicket::with('user')->get();
    return view('admin.user.view-user', compact('tickets'));
 }

 public function viewCounter()
 {
     $user = UserTicket::all();
     return view('admin.user.counter', compact('user'));
 }

public function updateStatus(Request $request)
{
    // Validate incoming request data
    $validated = $request->validate([
        'user_id' => 'required|exists:user_tickets,id',
        'status' => 'required|in:waiting,active,completed,expired',
    ]);

    // Find the user ticket based on user_id
    $userTicket = UserTicket::find($validated['user_id']);

    if ($userTicket) {
        // Update the status and save
        $userTicket->status = $validated['status'];
        $userTicket->save();

        return redirect()->route('admin.user.view-user')->with('success', 'User status updated successfully!');
    } else {
        return redirect()->route('admin.user.view-user')->with('error', 'User ticket not found.');
    }
}
public function getFilteredTickets(Request $request)
{
    // Get the current date and time
    $now = Carbon::now();

    // Filter tickets based on the selected status
    $statusFilter = $request->input('status');

    // Query tickets based on the expiration time
    $user = UserTicket::query()
        ->when($statusFilter, function ($query, $statusFilter) use ($now) {
            if ($statusFilter == 'expired') {
                // Show tickets that are expired
                return $query->where('expires_at', '<', $now);
            } elseif ($statusFilter == 'waiting') {
                // Show tickets that are not expired (waiting or active)
                return $query->where('expires_at', '>', $now);
            }
        })
        ->get();

    $user->each(function ($userTicket) use ($now) {
        // Check if the ticket is expired based on expires_at
        if (Carbon::parse($userTicket->expires_at)->isPast() && $userTicket->status != 'expired') {
            $userTicket->status = 'expired';  // Mark the ticket as expired
            $userTicket->save();  // Save the updated status in the database
        }
    });

    return view('admin.user.view-user', compact('user'));
}

public function showTicketsByCounter(Request $request)
{
    $counterName = $request->input('counter'); 

    $tickets = DB::table('user_tickets')
        ->join('queue_create', 'user_tickets.queue_id', '=', 'queue_create.id')
        ->select('user_tickets.*', 'queue_create.queue_name')
        ->when($counterName, function ($query) use ($counterName) {
            return $query->where('queue_create.queue_name', $counterName);
        })
        ->orderBy('user_tickets.created_at', 'asc')
        ->get();

    return view('admin.user.counter', compact('tickets', 'counterName'));
}

public function checkUserStatus()
{
    $user = auth()->user();
    $ticket = UserTicket::where('user_id', $user->id)->latest()->first();

    if (!$ticket) {
        return redirect()->route('display')->with('error', 'No ticket found.');
    }

    // Redirect based on ticket status
    switch ($ticket->status) {
        case 'waiting':
            return redirect()->route('display');
        case 'active':
            return redirect()->route('display-counter');
        case 'completed':
            return redirect()->route('display-completed');
        default:
            return redirect()->route('display');
    }
}

public function updateTicketStatus(Request $request, $ticketId)
    {
        $ticket = UserTicket::find($ticketId);

        if (!$ticket) {
            return response()->json(['error' => 'Ticket not found'], 404);
        }

        // Update the status
        $ticket->status = $request->status;
        $ticket->save();

        if ($request->status === 'active') {
            $this->notifyUserTurn($ticket);
        }

        return response()->json(['message' => 'Ticket status updated successfully']);
    }

    private function notifyUserTurn($ticket)
    {
        $user = User::find($ticket->user_id);
        if ($user) {
            dd([
                'sending_sms_to' => $user->phone,
                'ticket_number' => $ticket->ticket_number,
                'queue_name' => $ticket->queue_name
            ]);

        $user->notify(new UserTurnNotification($ticket));
    }
    }

    public function search(Request $request)
{
    $query = $request->input('query'); // Get the search input

    $tickets = UserTicket::where('ticket_number', 'LIKE', "%{$query}%")
                        ->with('user') // This loads user data
                        ->get();

    return view('admin.user.view-user', compact('tickets', 'query'));
}

// public function showTicketStatus()
// {
//     $ticket = UserTicket::where('user_id', auth()->id())->first();

//     if ($ticket && $ticket->status == 'active') {
//         session()->flash('status_notification', 'It\'s your turn! Your ticket is now active.');
//     }

//     return view('user.ticket-status', compact('ticket'));
// }


}
