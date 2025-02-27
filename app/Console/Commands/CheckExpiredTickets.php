<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserTicket;
use Carbon\Carbon;

class CheckExpiredTickets extends Command
{
    protected $signature = 'tickets:check-expired'; // Command to run
    protected $description = 'Automatically mark expired tickets as expired';

    public function handle()
    {
        $now = Carbon::now(); // Get the current time

        // Update tickets that have expired
        $expiredTickets = UserTicket::where('status', '!=', 'expired')
            ->where('expires_at', '<', $now)
            ->update(['status' => 'expired']);

        $this->info("Expired tickets checked and updated: $expiredTickets");
    }
}
