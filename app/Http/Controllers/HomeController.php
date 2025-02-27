<?php

namespace App\Http\Controllers;

use App\Models\UserTicket;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $activeTickets = UserTicket::where('status', 'waiting')->count();
        $completedTickets = UserTicket::where('status', 'completed')->count();
        $expiredTickets = UserTicket::where('expires_at', '<', now())->count();
        $pendingTickets = UserTicket::where('status', 'in progress')->count();

        return view('admin.dashboard', compact('activeTickets', 'completedTickets', 'expiredTickets', 'pendingTickets'));
    }
}