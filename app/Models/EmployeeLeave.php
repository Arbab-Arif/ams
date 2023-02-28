<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeave extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'casual_leave',
        'sick_leave',
        'earned_leave',
        'maternity_leave',
        'leave'
    ];

    public function user()
    {
        return  $this->belongsTo(User::class);
    }

}
