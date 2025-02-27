<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Queue;

class UserTicket extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'queue_id', 'ticket_number', 'name', 'email', 'notes', 'phone', 'age', 'gender','status','expires_at'];
    protected $casts =[
        'created_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function queue()
    {
        return $this->belongsTo(Queue::class);
    }

    // Generate a unique ticket number based on queue code
    public static function generateTicketNumber($queueCode)
{
    // Find the highest existing ticket number with the same queue code prefix
    $latestTicket = self::where('ticket_number', 'LIKE', $queueCode . '-%')
        ->orderByDesc('ticket_number')
        ->value('ticket_number');

    // Extract the number part and increment
    $nextNumber = 1;
    if ($latestTicket) {
        $latestNumber = (int) substr($latestTicket, strlen($queueCode) + 1); // Extract numeric part
        $nextNumber = $latestNumber + 1;
    }

    // Format the new ticket number
    return strtoupper($queueCode) . '-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

}

}


