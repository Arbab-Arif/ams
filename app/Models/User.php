<?php

namespace App\Models;

use App\Traits\HasDepartment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{

    use HasFactory, Notifiable, HasDepartment;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'department_id',
        'company_id',
        'email',
        'password',
        'employee_code',
        'employer_name',
        'company_code',
        'cnic',
        'city',
        'dob',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'status'    => 'boolean'
    ];

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function employeeLeaves()
    {
        return $this->hasMany(EmployeeLeave::class);
    }

    public static function boot()
    {
        parent::boot();
        static::created(fn($user) => $user->addEmployeeLeaves());
    }

    public function addEmployeeLeaves()
    {
        $leaveSetups = LeaveSetup::all();
        $leaveSetups = $leaveSetups->pluck('leave_allowed', 'leave_type')->toArray();

        $dateOfJoining = new \Carbon\Carbon($this->dob);

        $employeeLeaves = [];

        foreach ($leaveSetups as $leaveType => $allowedLeaves) {
            $key = Str::slug($leaveType, '_');
            $perMonthLeave = $allowedLeaves / 12;

            $remainingMonth = (12 - $dateOfJoining->format('m')) + 1;

            $remainingLeaves = (int)round($perMonthLeave * $remainingMonth);
            $employeeLeaves[$key] = $remainingLeaves;
        }

        return $this->employeeLeaves()->create($employeeLeaves);
    }

    public function leaveRequest()
    {
        return $this->hasMany(LeaveRequest::class);
    }
}
