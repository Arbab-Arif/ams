<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\Admin;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{

    public function index()
    {
        return view('admin.dashboard')
            ->with([
                'tasksCount'     => Task::count(),
                'pendingTasks'   => Task::whereNull('complete_at')->count(),
                'completedTasks' => Task::whereNotNull('complete_at')->count(),
                'employeesCount' => User::count()
            ]);
    }

    public function create()
    {
        return view('admin.auth.passwords.change');
    }

    public function store(request $request)
    {
        $request->validate([
            'current_password' => ['required', new matcholdpassword],
            'new_password' => ['required'],
            'confirm_password' => ['same:new_password'],
        ]);

        admin::find(auth()->user()->id)->update(['password'=> $request->get('new_password')]);
        return redirect()->back()->with('success','password change successfully');
    }

}
