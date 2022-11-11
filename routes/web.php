<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\WorkSheetController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\LogoutController;

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
    return view('auth.login');
});
//使用者打卡畫面
Route::get('/dashboard', [WorkController::class,'index'])->middleware(['auth'])->name('dashboard');
Route::post('/dashboard', [WorkController::class,'store'])->middleware(['auth'])->name('dashboard.worktime');

//使用者出勤畫面
Route::get('/personwork', [WorkController::class,'personwork'])->middleware(['auth'])->name('personwork');

//工作表畫面
Route::get('/worksheet', [WorkSheetController::class,'index'])->middleware(['auth'])->name('worksheet');
Route::get('/addworksheet', [WorkSheetController::class,'create'])->middleware(['auth'])->name('addworksheet');
Route::post('/addworksheet', [WorkSheetController::class,'store'])->middleware(['auth'])->name('addworksheet.data');
Route::post('/worksheet', [WorkSheetController::class,'edit'])->middleware(['auth'])->name('click_over_sheet.data');
Route::get('/editworksheet/{workId}', [WorkSheetController::class,'show'])->middleware(['auth'])->name('editworksheet');
Route::post('/editworksheet/{workId}', [WorkSheetController::class,'update'])->middleware(['auth'])->name('editworksheet.data');
Route::get('/oversheet', [WorkSheetController::class,'overindex'])->middleware(['auth'])->name('oversheet');
Route::post('/oversheet', [WorkSheetController::class,'overupdate'])->middleware(['auth'])->name('oversheet.data');

//管理者查看使用者出勤畫面
Route::get('/userwork/{userId}', [WorkController::class,'userwork'])->middleware(['auth'])->name('userwork');

//管理者編輯使用者出勤畫面
Route::get('/edituserwork/{workId}', [WorkController::class,'showuserwork'])->middleware(['auth'])->name('editUserWork');
Route::post('/edituserwork/{workId}', [WorkController::class,'edituserwork'])->middleware(['auth'])->name('editUserWork.data');

//管理者刪除使用者出勤畫面
Route::get('/deluserwork/{workId}', [WorkController::class,'showdeluserwork'])->middleware(['auth'])->name('delUserWork');
Route::post('/deluserwork/{workId}', [WorkController::class,'deluserwork'])->middleware(['auth'])->name('delUserWork.data');

//使用者變更密碼
Route::get('/editpassword/{userId}', [UserController::class,'showpassword'])->name('editpassword');
Route::post('/editpassword/{userId}', [UserController::class,'editpassword'])->name('editpassword.data');

//使用者編輯個人資訊
Route::get('/person/{userId}', [UserController::class,'personshow'])->name('person');
Route::post('/person/{userId}', [UserController::class,'personedit'])->name('person.data');

//管理者-使用者管理
Route::get('/user', [UserController::class,'index'])->name('user');

//管理者-新增使用者
Route::get('/adduser', [UserController::class,'create'])->name('addUser');
Route::post('/adduser', [UserController::class,'store'])->name('addUser.data');

//管理者-編輯使用者
Route::get('/user/{userId}', [UserController::class,'show'])->name('editUser');
Route::post('/user/{userId}', [UserController::class,'edit'])->name('editUser.data');
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

//管理者-軌跡紀錄
Route::get('/log', [LogController::class,'index'])->name('log');
Route::get('/user-log', [LogController::class,'userlog'])->name('userlog');
Route::get('/work-log', [LogController::class,'worklog'])->name('worklog');

require __DIR__.'/auth.php';
