<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Ticket;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number')->unique();
            $table->string('purpose');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function generateTicket($user_id = 'Guest')
{
    $last_ticket = Ticket::latest()->first();
    $ticket_number = $last_ticket ? $last_ticket->ticket_number + 1 : 1;

    Ticket::create([
        'user_id' => $user_id,
        'ticket_number' => $ticket_number,
    ]);

    return view('ticket', compact('user_id', 'ticket_number'));
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
