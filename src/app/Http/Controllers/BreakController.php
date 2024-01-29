<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Breaklog;
use App\Models\Attendance;
use App\Http\Controllers\StampController;
use Carbon\Carbon;


class BreakController extends Controller
{
    public function startBreak()
    {
        $user = Auth::user();
        $today = now()->format('Y-m-d');
        $attendanceId = $this->getTodayAttendanceId($user->id);

        // 既に休憩が開始されているかチェック
        $existingBreak = Breaklog::where('attendance_id', $attendanceId)
        ->where('user_id', $user->id)
        ->where('type', 'start')
        ->exists();

        if ($existingBreak) {
            $message = '既に休憩が開始されています';
                } else {
                // 休憩データを新規作成
                $break = new Breaklog([
                    'user_id' => $user->id,
                    'attendance_id' => $attendanceId,
                    'type' => 'start',
                    'timestamp' => now(),
                ]);
                $break->save();

                $message = '休憩を開始しました';
            } 
            
            if (request()->ajax()) {
                return response()->json(['success' => !$existingBreak, 'message' => $message]);
                } else {
                    // 通常のHTTPリクエストの場合は /stamp にリダイレクト
                return redirect('/stamp')->with($existingBreak ? 'error' : 'success', $message);
        }
    }

    public function endBreak()
    {
        $user = Auth::user();
        $today = now()->format('Y-m-d');
        $attendanceId = $this->getTodayAttendanceId($user->id);

        // 休憩データを新規作成
        $break = new Breaklog([
            'user_id' => $user->id,
            'attendance_id' => $attendanceId,
            'type' => 'end',
            'timestamp' => now(),
        ]);
        $break->save();

        // 休憩時間の計算
        $startBreakTime = Breaklog::where('attendance_id', $attendanceId)->where('type', 'start')->latest()->first();

        if ($startBreakTime) {
            $totalBreakTime = now()->diffInMinutes($startBreakTime->timestamp);
            $break->break_time = $totalBreakTime;
            $break->save();
        }

        $message = '休憩を終了しました';

        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => $message]);
        } else {
            // 通常のHTTPリクエストの場合は /stamp にリダイレクト
            return redirect('/stamp')->with('success', $message);
        }
    }

    
    private function getTodayAttendanceId($userId)
    {
        $today = now()->format('Y-m-d');
        $attendance = Attendance::where(['user_id' => $userId, 'date' => $today])->first();

        // 存在しない場合は新しい勤怠データを作成
        if (!$attendance) {
            $attendance = new Attendance([
                'user_id' => $userId,
                'date' => $today,
            ]);
            $attendance->save();
        }
        return $attendance ->id;
    }

}
