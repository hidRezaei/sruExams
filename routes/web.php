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

Route::get('/admin', function () {
    return view('admin.index');

})->middleware(['auth'])->name('admin');

Route::middleware(['auth'])->resource('/admin/student', \App\Http\Controllers\Administrator\StudentController::class)->parameters(['student'=>'id']);

require __DIR__.'/auth.php';
