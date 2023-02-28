<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group(
    [ 'namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin', 'as' => 'admin.' ],
    fn() => Auth::routes([
        'register' => false,
        'confirm'  => false,
        'verify'   => false
    ])
);
