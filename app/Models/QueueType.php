<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueueType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function queue()
    {
        return $this->hasMany(Queue::class, 'queue_type');
    }
}
