<?php


namespace App\Http\Controllers;


class TaskController extends Controller
{
    public function index()
    {
        return view('admin.task.index');
    }
}
