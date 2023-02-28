<?php

namespace App\Models;

use App\Traits\HasDepartment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use HasFactory, HasDepartment;

    protected $fillable = [
        'user_id',
        'company_id',
        'leave_setup_id',
        'department_id',
        'start_date',
        'end_date',
        'days_count',
        'status',
        'reason'
    ];

    protected $casts = [
        'boolean' => 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function leaveSetup()
    {
        return $this->belongsTo(LeaveSetup::class);
    }
}
