<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home')
            ->with([
                'tasksCount'     => Task::count(),
                'pendingTasks'   => Task::whereNull('complete_at')->count(),
                'completedTasks' => Task::whereNotNull('complete_at')->count(),
            ]);
    }

    public function create()
    {
        return view('auth.passwords.change');
    }


    public function store(request $request)
    {
        $request->validate([
            'current_password' => ['required', new matcholdpassword],
            'new_password' => ['required'],
            'confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> bcrypt($request->get('new_password'))]);
        return redirect()->back()->with('success','password change successfully');
    }

}
