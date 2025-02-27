<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserTicket;
use Carbon\Carbon;

class UpdateExpiredTickets extends Command
{
    protected $signature = 'tickets:update-expired';  // Define the command name
    protected $description = 'Update tickets that have expired';  // Description of what the command does

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $now = Carbon::now();

        // Get all tickets with expired expiration time that haven't been marked as expired
        $expiredTickets = UserTicket::where('expires_at', '<', $now)
                                     ->where('status', '!=', 'expired')
                                     ->get();

        foreach ($expiredTickets as $ticket) {
            $ticket->status = 'expired'; // Set status to expired
            $ticket->save();

            $this->info("Ticket ID {$ticket->id} marked as expired.");
        }

        $this->info('Expired tickets updated successfully.');
    }
}
