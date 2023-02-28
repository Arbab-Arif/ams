<?php

namespace App\Models;

use App\Traits\HasCompany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory, HasCompany;

    protected $fillable = [
        'company_id',
        'name'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
