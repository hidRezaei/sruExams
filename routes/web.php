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
    return view('welcome');
});

Route::get('/admin', function () { return view('admin.index');})->middleware(['auth'])->name('admin');
Route::get('/admin/dashboard', function () { return view('admin.dashboard');})->middleware(['auth'])->name('adminDashboard');

Route::middleware(['auth'])->resource('/admin/student', \App\Http\Controllers\Administrator\StudentController::class)->parameters(['student'=>'id']);


Route::get('/stlogin', function () { return view('student_login');})->name('stlogin');
require __DIR__.'/auth.php';
