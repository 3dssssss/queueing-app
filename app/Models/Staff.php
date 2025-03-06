<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    
    protected $table = 'staff';
    protected $fillable = ['name', 'email', 'password'];

    public function counter()
    {
        return $this->hasOne(Queue::class, 'staff_id');
    }
}
