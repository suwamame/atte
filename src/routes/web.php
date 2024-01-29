<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\Paginator;
use App\Http\Middleware\CheckAttendanceMiddleware;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\StampController;
use App\Http\Controllers\BreakController;
use App\Http\Controllers\AttendanceController;




Route::get('/', function () {
    return view('welcome');
});



Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login',[AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.post');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::group(['middleware' => 'web'], function () {
Route::get('/stamp', [StampController::class, 'create'])->name('stamp.page');

//勤務開始
Route::post('/start-working', [StampController::class, 'startWorking'])
    ->name('start.working')
    ->middleware(['check.attendance:start']);
//勤務終了
Route::post('/end-working', [StampController::class, 'endWorking'])
    ->name('end.working')
    ->middleware(['check.attendance:end']);

 // 休憩開始・終了
Route::post('/start-break', [BreakController::class, 'startBreak'])->name('start.break');
Route::post('/end-break', [BreakController::class, 'endBreak'])->name('end.break');

//日付一覧ビュー
Route::get('/attendance', [AttendanceController::class, 'create'])->name('attendances.create');
Route::get('/attendance', [AttendanceController::class, 'index']);

});
