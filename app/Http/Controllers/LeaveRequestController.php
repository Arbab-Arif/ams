<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeaveRequestStore;
use App\Models\LeaveRequest;
use App\Models\LeaveSetup;

class LeaveRequestController extends Controller
{

    public function index()
    {
        return view('admin.leave-request.index');
    }

    public function create()
    {
        $leaveSetups = LeaveSetup::all();
        return view('admin.leave-request.create', compact('leaveSetups'));
    }

    public function store(LeaveRequestStore $request)
    {
        $leaveRequest = $request->all();
        $user = auth()->user();
        $leaveRequest['user_id'] = $user->id;
        $leaveRequest['company_id'] = $user->company_id;
        $leaveRequest['department_id'] = $user->department_id;

        $startDate = new \Carbon\Carbon($request->get('start_date'));
        $leaveRequest['start_date'] = $request->get('start_date');
        $leaveRequest['end_date'] = $startDate->addDays($request->get('days_count'));
        $leaveRequest['status'] = 'PENDING';
        LeaveRequest::create($leaveRequest);

        return redirect()->route('leave_request.index');

    }

}
