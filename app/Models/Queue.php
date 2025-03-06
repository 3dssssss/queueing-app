<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    use HasFactory;

    protected $table = 'queue_create';

    protected $fillable = [
        'queue_name',
        'queue_type',
        'queue_code',
        'department',
        'ticket_counter',
        'staff_id',
    ];

    public function assignedServices()
    {
        return $this->belongsToMany(Queue::class, 'counter_services', 'counter_id', 'service_id');
    }

    public function counters()
    {
        return $this->belongsToMany(Queue::class, 'counter_services', 'service_id', 'counter_id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    public function userTickets()
    {
    return $this->hasMany(UserTicket::class, 'queue_id', 'id');
    }

}
