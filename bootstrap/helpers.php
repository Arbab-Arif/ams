<?php

if (!function_exists('isAdmin')) {
    function isAdmin()
    {
        return auth('admin')->check();
    }
}

if (!function_exists('isSuperAdmin')) {
    function isSuperAdmin()
    {
        return !session()->has('department_id') && !session()->has('company_id');
    }
}

if (!function_exists('isCompanyAdmin')) {
    function isCompanyAdmin()
    {
        return !session()->has('department_id') && session()->has('company_id');
    }
}

if (!function_exists('isDepartmentAdmin')) {
    function isDepartmentAdmin()
    {
        return session()->has('department_id') && session()->has('company_id');
    }
}

if (!function_exists('calculateFlexibleTime')) {
    function calculateFlexibleTime($date, $timeIn, $timeOut, $timeLimit)
    {
        $timeOut = (new Carbon\Carbon("{$date} {$timeOut}"));
        $time = (new Carbon\Carbon("{$date} {$timeIn}"))->diffInHours($timeOut);

        $overtime = $time - $timeLimit;

        if ($overtime < 0) return 0;

        return $overtime;
    }
}
