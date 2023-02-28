<?php

namespace App\Http\Controllers;

class ImpersonateController extends Controller
{

    public function leave()
    {
        abort_if(!session()->has('impersonate'), 403);

        $adminId = session('impersonate');

        auth()->logout();

        auth('admin')->loginUsingId($adminId);

        session()->forget('impersonate');

        return redirect()->route('admin.employee.index');
    }

}
