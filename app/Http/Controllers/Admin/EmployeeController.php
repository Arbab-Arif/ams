<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function index()
    {
        return view('admin.employee.index');
    }

    public function edit(User $employee)
    {
        $departments = Company::all();
        return view('admin.employee.edit', compact('employee', 'departments'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('admin.employee.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name'          => 'required',
            'email'         => 'required',
            'password'      => 'required',
            'employee_code' => 'required',
            'employer_name' => 'required',
            'company_code'  => 'required',
            'cnic'          => 'required',
            'dob'           => 'required',
        ];

        if (isSuperAdmin())
            $rules['department_id'] = 'required';

        $request->validate($rules);

        $employee = $request->all();
        $employee['password'] = bcrypt($request->get('password'));
        $employee['city'] = 'karachi';

        if (!isSuperAdmin())
            $employee['department_id'] = session('department_id');
            $employee['company_id'] = session('company_id');

        User::create($employee);

        return redirect()->route('admin.employee.index');
    }

    public function update(Request $request, User $employee)
    {
        $rules = [
            'name'          => 'required',
            'email'         => 'required',
            'employee_code' => 'required',
            'employer_name' => 'required',
            'company_code'  => 'required',
            'cnic'          => 'required',
            'dob'           => 'required'
        ];

        if (isSuperAdmin())
            $rules['department_id'] = 'required';

        $request->validate($rules);

        if (!isSuperAdmin())
            $request['department_id'] = session('department_id');

        $request['department_id'] = $employee->department_id;
        $employee->update($request->all());

        return redirect()->route('admin.employee.index');
    }

    public function attendance(User $user)
    {
        $attendances = $user->attendance()->paginate(10);
        return view('admin.employee.attendance', compact('attendances'));
    }

}
