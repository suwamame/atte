<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Breaklog;
use App\Models\Attendance;
use App\Http\Controllers\StampController;

class BreakController extends Controller
{
    public function startBreak()
    {
        $user = Auth::user();
        $today = now()->format('Y-m-d');

        // 休憩データを新規作成
        $break = new Breaklog([
            'user_id' => $user->id,
            'attendance_id' => $this->getTodayAttendanceId($user->id),
            'type' => 'start',
            'timestamp' => now(),
        ]);
        $break->save();

        return response()->json(['success' => true, 'message' => '休憩を開始しました']);
    }

    public function endBreak()
    {
        $user = Auth::user();
        $today = now()->format('Y-m-d');

        // 休憩データを新規作成
        $break = new Breaklog([
            'user_id' => $user->id,
            'attendance_id' => $this->getTodayAttendanceId($user->id),
            'type' => 'end',
            'timestamp' => now(),
        ]);
        $break->save();

        return response()->json(['success' => true, 'message' => '休憩を終了しました']);
    }
    
    private function getTodayAttendanceId($userId)
    {
        $today = now()->format('Y-m-d');
        $attendance = Attendance::where(['user_id' => $userId, 'date' => $today])->first();

        return $attendance ? $attendance->id : null;
    }

}
