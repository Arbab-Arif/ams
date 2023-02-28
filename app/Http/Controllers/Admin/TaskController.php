<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Models\Company;
use App\Models\Task;
use App\Models\User;

class TaskController extends Controller
{

    public function index()
    {
        return view('admin.task.index');
    }

    public function create()
    {
        $employees = User::all();
        $departments = Company::all();
        return view('admin.task.create', compact('employees', 'departments'));
    }

    public function store(TaskStoreRequest $request)
    {
        $task = $request->all();
        $task['assigned_at'] = date('Y-m-d h:m');

        if (!isSuperAdmin())
            $task['department_id'] = session('department_id');
            $task['company_id'] = session('company_id');

        Task::create($task);
        return redirect()->route('admin.task.index');
    }

    public function edit(Task $task)
    {
        $employees = User::all();
        $departments = Company::all();
        return view('admin.task.edit', compact('task', 'employees', 'departments'));
    }

    public function update(TaskUpdateRequest $request, Task $task)
    {
        $taskData = $request->all();

        if (!isSuperAdmin())
            $task['department_id'] = session('department_id');
            $task['company_id'] = session('company_id');

        $task->update($taskData);
        return redirect()->route('admin.task.index');
    }

}
