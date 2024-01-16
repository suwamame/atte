<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckAttendanceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // ユーザーの勤怠状態をセッションから取得
        $attendanceStatus = Session::get('attendance_status', 'not_started');
        $type = $request->input('type', '');

        // 勤怠が開始されている場合はエラーメッセージを表示してリダイレクト
        if ($attendanceStatus === 'started' && $type === 'start') {
            return redirect()->back()->with('error', '既に勤怠が開始されています');
        }

        // 勤怠が終了している場合はエラーメッセージを表示してリダイレクト
        if ($attendanceStatus === 'ended' && $type === 'end') {
            return redirect()->back()->with('error', '勤怠が終了しています');
        }

        // 勤怠が開始されていない場合はセッションに状態を設定
        if ($attendanceStatus === 'not_started' && $type === 'start') {
            Session::put('attendance_status', 'started');
        }

        // 勤怠が終了していない場合はセッションに状態を設定
        if ($attendanceStatus === 'not_ended' && $type === 'end') {
            Session::put('attendance_status', 'ended');
        }

        // 勤怠が開始または終了されていない場合は次のミドルウェアまたはコントローラーに進む
        return $next($request);
    }
}
