<?php

use App\Http\Controllers\Student\Auth\LoginController;
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

Route::namespace('Student')->prefix('student')->group(function (){
    Route::get('/',function(){return view ('student.home');})->middleware(['auth:student'])->name('student.home');
    //Route::get('/result',function(){return view ('student.result');})->middleware(['auth:student'])->name('student.result');
    Route::get('/result',[\App\Http\Controllers\Student\homeController::class,'getResultPageData'])->middleware(['auth:student'])->name('student.result');

    Route::namespace('Auth')->group(function(){
        //Route::get('/login',function(){return view ('student.login');})->name('student.login');
        Route::get('/login',[LoginController::class, 'create'])->name('student.login');
        Route::post('/login', [LoginController::class, 'store'])->name('student.lgStore');
        Route::post('logout', [LoginController::class, 'destroy'])->name('student.logout');
    });

    //Route::get('/resultFiles/{filename}',[\App\Http\Controllers\Student\homeController::class, 'displayImage'])->middleware(['auth:student'])->name('image.displayImage');
});

Route::get('/getAns/{QN}/{filename}',[\App\Http\Controllers\Student\homeController::class, 'displayImage'])->name('image.displayImage');

Route::get('/stlogin', function () { return view('student_login');})->name('stlogin');
require __DIR__.'/auth.php';
