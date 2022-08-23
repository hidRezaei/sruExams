<?php

use App\Http\Controllers\Student\Auth\LoginController;
use App\Http\Controllers\Student\messageController;
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

//Route::get('/', function () {return view('welcome');});
Route::get('/', function () {return abort(404);});

Route::get('/admin', function () { return view('admin.dashboard');})->middleware(['auth'])->name('admin');
Route::get('/admin/dashboard', function () { return view('admin.dashboard');})->middleware(['auth'])->name('adminDashboard');

Route::middleware(['auth'])->resource('/admin/student', \App\Http\Controllers\Administrator\StudentController::class)->parameters(['student'=>'id']);
Route::middleware(['auth','admin'])->resource('/admin/mosaheh', \App\Http\Controllers\Administrator\mosahehController::class)->parameters(['mosaheh'=>'id']);
Route::middleware(['auth','admin'])->resource('/admin/comiteRaes', \App\Http\Controllers\Administrator\comiteRaesController::class)->parameters(['comiteRaes'=>'id']);
Route::resource('admin.message',\App\Http\Controllers\Administrator\messageController::class)->parameters(['admin'=>'aid','message'=>'mid'])->middleware(['auth']);
Route::resource('admin.elanat',\App\Http\Controllers\Administrator\elanatController::class)->parameters(['admin'=>'aid','elanat'=>'eid'])->middleware(['auth']);
Route::middleware(['auth'])->resource('/admin/doreh',\App\Http\Controllers\Administrator\dorehController::class)->parameters(['doreh'=>'did']);

Route::get('/admin/doreh/{did}/dorehSteps',[\App\Http\Controllers\Administrator\dorehController::class,'getdorehSteps'])->middleware(['auth'])->name('dorehSteps');
Route::post('/admin/doreh/{did}/dorehSteps',[\App\Http\Controllers\Administrator\dorehController::class,'dorehStepStore'])->middleware(['auth'])->name('dorehStepStore');
Route::delete('/admin/doreh/{sid}/dorehSteps',[\App\Http\Controllers\Administrator\dorehController::class,'dorehStepDestroy'])->middleware(['auth'])->name('dorehStepDestroy');

Route::get('/admin/doreh/{did}/step/{sid}/dorehStepLessons',[\App\Http\Controllers\Administrator\dorehController::class,'getDorehStepLessons'])->middleware(['auth'])->name('dorehStepLessons');
Route::post('/admin/doreh/{did}/step/{sid}/dorehStepLessons',[\App\Http\Controllers\Administrator\dorehController::class,'dorehStepLessonsStore'])->middleware(['auth'])->name('dorehStepLessonsStore');

Route::middleware(['auth'])->resource('/admin/lesson',\App\Http\Controllers\Administrator\lessonController::class)->parameters(['lesson'=>'lid']);


Route::get('/tashih',[\App\Http\Controllers\Administrator\tashihController::class,'index'])->middleware(['auth','mosaheh'])->name('tashih');
Route::get('/tashihEdit/{sid}/{lid}/{qid}',[\App\Http\Controllers\Administrator\tashihController::class,'edit'])->middleware(['auth','mosaheh'])->name('tashihEdit');
Route::put('/tashihStoreUpdate/{mid}',[\App\Http\Controllers\Administrator\tashihController::class,'store_update'])->middleware(['auth','mosaheh'])->name('tashihStoreUpdate');

Route::get('/tashihTaed',[\App\Http\Controllers\Administrator\tashihTaedController::class,'index'])->middleware(['auth','nazer'])->name('tashihTaed');
Route::get('/tashihTaedEdit/{sid}/{lid}/{qid}',[\App\Http\Controllers\Administrator\tashihTaedController::class,'edit'])->middleware(['auth','nazer'])->name('tashihTaedEdit');
Route::put('/tashihTaedStoreUpdate/{uid}',[\App\Http\Controllers\Administrator\tashihTaedController::class,'store_update'])->middleware(['auth','nazer'])->name('tashihTaedStoreUpdate');

Route::get('/tashihSt',[\App\Http\Controllers\Administrator\tashihStatusController::class,'index'])->middleware(['auth','admin'])->name('tashihStatus');
Route::get('/tashihStView/{sid}/{lid}/{qid}',[\App\Http\Controllers\Administrator\tashihStatusController::class,'view'])->middleware(['auth','admin'])->name('tashihStatusView');
//Route::put('/tashihStoreUpdate/{mid}',[\App\Http\Controllers\Administrator\tashihController::class,'store_update'])->middleware(['auth','mosaheh'])->name('tashihStoreUpdate');

Route::get('/setting',[\App\Http\Controllers\Administrator\settingController::class,'getSetting'])->middleware(['auth'])->name('admin.setting');
Route::post('/setting',[\App\Http\Controllers\Administrator\settingController::class,'updateSetting'])->middleware(['auth'])->name('admin.setting');





Route::namespace('Student')->prefix('student')->group(function (){
    Route::get('/',[\App\Http\Controllers\Student\homeController::class,'getHomeData'])->middleware(['auth:student'])->name('student.home');
    Route::get('/result',[\App\Http\Controllers\Student\homeController::class,'getResultPageData'])->middleware(['auth:student'])->name('student.result');

    Route::get('/profile/{id}',[\App\Http\Controllers\Student\profileController::class,'getStudentData'])->middleware(['auth:student'])->name('student.profile');
    Route::post('/profile/{id}',[\App\Http\Controllers\Student\profileController::class,'updateStudentProfile'])->middleware(['auth:student'])->name('student.updateProfile');

    Route::namespace('Auth')->group(function(){
        //Route::get('/login',function(){return view ('student.login');})->name('student.login');
        Route::get('/login',[LoginController::class, 'create'])->name('student.login');
        Route::post('/login', [LoginController::class, 'store'])->name('student.lgStore');
        Route::post('logout', [LoginController::class, 'destroy'])->name('student.logout');
    });

    //Route::get('/resultFiles/{filename}',[\App\Http\Controllers\Student\homeController::class, 'displayImage'])->middleware(['auth:student'])->name('image.displayImage');
});

Route::resource('student.message',messageController::class)->parameters(['student'=>'sid','message'=>'mid'])->middleware(['auth:student']);


Route::get('/getAns2/{stcode}/{lessonNumber}/{QN}/{filename}',[\App\Http\Controllers\Administrator\tashihController::class, 'getAnswerImage'])->middleware(['auth'])->name('displayAnswerImage');


Route::get('/getAns/{lessonNumber}/{QN}/{filename}',[\App\Http\Controllers\Student\homeController::class, 'displayImage'])->middleware(['auth:student'])->name('image.displayImage');
Route::get('/getKarname/{lessonNumber}',[\App\Http\Controllers\Student\homeController::class, 'getKarname'])->middleware(['auth:student'])->name('student.karname');

Route::get('/stlogin', function () { return view('student_login');})->name('stlogin');
require __DIR__.'/auth.php';
