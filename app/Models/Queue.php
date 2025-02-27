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
    ];
}
