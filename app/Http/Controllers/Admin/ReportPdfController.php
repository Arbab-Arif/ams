<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class ReportPdfController extends Controller
{
    public function departmentReport()
    {
        $data = Department::with('users')
            ->orderBy('id', 'desc')
            ->get();
        $pdf = app()->make('dompdf.wrapper');
        $view = view('admin.reports.department_report_pdf', compact('data'))->render();
        $pdf->loadHTML($view)->setPaper('a4', 'landscape');
        return $pdf->stream("daily-attendance-report.pdf");
    }

    public function employeeReport(Request $request)
    {
        $data = collect(json_decode($request->get('data')));
        $pdf = app()->make('dompdf.wrapper');
        $view = view('admin.reports.employee_report_pdf', compact('data'))->render();
        $pdf->loadHTML($view)->setPaper('a4', 'landscape');
        return $pdf->stream("employee-report.pdf");
    }

    public function dailyAttendanceReport(Request $request)
    {
        $data = Department::with('users')
            ->orderBy('id', 'desc')
            ->get();
        $pdf = app()->make('dompdf.wrapper');
        $view = view('admin.reports.department_report_pdf', compact('data'))->render();
        $pdf->loadHTML($view)->setPaper('a4', 'landscape');
        return $pdf->stream("daily-attendance-report.pdf");
    }
}
