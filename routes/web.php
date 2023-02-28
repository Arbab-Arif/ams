<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/leave_impersonation', [App\Http\Controllers\ImpersonateController::class, 'leave'])->name('leave-impersonation');
Route::get('/employee/task', [App\Http\Controllers\TaskController::class, 'index'])->name('employee.task.index');
Route::resource('/employee/leave_request', App\Http\Controllers\LeaveRequestController::class);
Route::get('/employee/change_password', [App\Http\Controllers\HomeController::class, 'create'])->name('employee.change.password');
Route::post('/employee/change_password', [App\Http\Controllers\HomeController::class, 'store'])->name('employee.change.password');
