<?php

use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/change_password', [Admin\DashboardController::class, 'create'])->name('change.password');
    Route::post('/change_password', [Admin\DashboardController::class, 'store'])->name('change.password');
//    Route::view('employee', 'admin.employee.index')->name('employee.index');
    Route::resource('employee', Admin\EmployeeController::class);
//    Route::get('employee/{user}', [Admin\EmployeeController::class, 'edit'])->name('employee.edit');
//    Route::put('employee/{user}', [Admin\EmployeeController::class, 'update'])->name('employee.update');
    Route::get('employee/{user}/attendance', [Admin\EmployeeController::class, 'attendance'])->name('employee.attendance');
    Route::resource('task', Admin\TaskController::class);
    Route::resource('sub_admin', Admin\SubAdminController::class);
    Route::resource('company', Admin\CompanyController::class)->except('show', 'delete');
    Route::resource('department', Admin\DepartmentController::class)->except('show', 'delete');
    Route::resource('leave', Admin\LeaveController::class)->except('show', 'delete');
    Route::resource('opening', Admin\LeaveController::class)->except('show', 'delete');
    Route::resource('leave_request', App\Http\Controllers\LeaveRequestController::class);
    Route::post('daily_attendance_report_pdf', [Admin\ReportPdfController::class,'dailyAttendanceReport'])->name('daily.attendance.report');

    Route::group(['as' => 'report.', 'prefix' => 'report'], function () {
        Route::view('employee_leave', 'admin.reports.employee_leave_report')->name('employee.leave');

        Route::view('department', 'admin.reports.department_report')->name('department');
        Route::get('department/pdf', [Admin\ReportPdfController::class,'departmentReport'])->name('department.pdf');

        Route::view('employee', 'admin.reports.employee_report')->name('employee');
        Route::post('employee/pdf', [Admin\ReportPdfController::class,'employeeReport'])->name('employee.pdf');

        Route::view('daily_attendance_report', 'admin.reports.daily_attendance')->name('daily');
        Route::view('monthly_attendance_report', 'admin.reports.monthly_attendance')->name('monthly');
    });
});
