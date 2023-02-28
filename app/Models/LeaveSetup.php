<?php

namespace App\Models;

use App\Traits\HasCompany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveSetup extends Model
{
    use HasFactory, HasCompany;

    protected $fillable = [
        'company_id',
        'leave_type',
        'leave_allowed'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    
}
