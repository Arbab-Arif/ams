<?php

namespace App\Models;

use App\Traits\HasDepartment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    use HasFactory, HasDepartment;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
        'assigned_at',
        'complete_at',
        'department_id',
        'company_id'
    ];

    protected $with = [
        'user'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
