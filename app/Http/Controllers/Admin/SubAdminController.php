<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\AdminStoreRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Models\Admin;
use App\Models\Company;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubAdminController extends Controller
{

    public function index()
    {
        return view('admin.sub_admin.index');
    }

    public function create()
    {
        $companies = Company::all();
        $departments = Department::all();
        return view('admin.sub_admin.create', compact('departments', 'companies'));
    }

    public function store(AdminStoreRequest $request)
    {
        $admin = $request->all();
        if (isCompanyAdmin()) {
            $admin['company_id'] = auth()->user()->company_id;
        }
        Admin::create($admin);
        return redirect()->route('admin.sub_admin.index');
    }

    public function edit(Admin $sub_admin)
    {
        $companies = Company::all();
        $departments = Department::all();
        return view('admin.sub_admin.edit', compact('sub_admin', 'departments', 'companies'));
    }

    public function update(AdminUpdateRequest $request, Admin $sub_admin)
    {
        $adminData = $request->all();

        if ($request->get('password') == '') {
            unset($adminData['password']);
        }

        $sub_admin->update($adminData);

        return redirect()->route('admin.sub_admin.index');
    }

}
