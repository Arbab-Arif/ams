<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\LeaveSetupStore;
use App\Models\Company;
use App\Models\LeaveSetup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function index()
    {
        return view('admin.leave.index');
    }

    public function create()
    {
        $companies = Company::all();
        return view('admin.leave.create', compact('companies'));
    }

    public function store(LeaveSetupStore $request)
    {
        $leaveSetup = $request->all();
        $leaveSetup['company_id'] = Auth::user()->company_id;
        LeaveSetup::create($leaveSetup);
        return redirect()->route('admin.leave.index');
    }

    public function edit(LeaveSetup $leave)
    {
//        dd('working');
        return view('admin.leave.edit', compact('leave'));
    }

    public function update(Request $request, LeaveSetup $leave)
    {
        $leave->update($request->all());
        return redirect()->route('admin.leave.index');
    }
}
